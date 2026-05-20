<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Throwable;

class ProductService
{
    public function __construct(
        protected ProductRepository $repository,
        protected MediaService $mediaService
    ) {}

    /**
     * Paginate products with optional search and category filter.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator<int, Product>
     */
    public function paginate(
        string $search = '',
        ?int $categoryId = null,
        int $perPage = 10
    ) {
        return $this->repository->paginate($search, $categoryId, $perPage);
    }

    /**
     * Find a product by ID with category loaded.
     */
    public function find(int $id): ?Product
    {
        return $this->repository->find($id)?->load('category');
    }

    /**
     * Find a product by slug.
     */
    public function findBySlug(string $slug): ?Product
    {
        return $this->repository->findBySlug($slug);
    }

    /**
     * Find a product by SKU.
     */
    public function findBySku(string $sku): ?Product
    {
        return $this->repository->findBySku($sku);
    }

    /**
     * Create a new product, optionally attaching an uploaded image.
     * Both the product insert and the media upload run inside a single
     * transaction so either both succeed or both are rolled back.
     *
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): Product
    {
        $image = $data['image'] ?? null;
        unset($data['image']);

        return DB::transaction(function () use ($data, $image): Product {
            $product = $this->repository->create($data);

            if ($image instanceof UploadedFile) {
                $this->mediaService->upload($image, 'products', $product, 'image');
            }

            return $product;
        });
    }

    /**
     * Update a product.
     *
     * Image replacement is two-phase so a product-DB failure does not leave
     * inconsistent state on disk or in the media table.
     *
     *  Phase A (outside transaction): replace old media + physical file with the
     *           new upload via MediaService::replace().
     *
     *  Phase B (inside transaction): update the product row. If this throws,
     *           roll back and delete any media records created in Phase A.
     *
     * @param  array<string, mixed>  $data
     */
    public function update(Product $product, array $data): Product
    {
        $image = $data['image'] ?? null;
        unset($data['image']);

        // Snapshot IDs before Phase A so we can detect orphans on Phase B failure.
        $preExistingIds = $this->mediaService->findByType($product, 'image')->pluck('id')->all();

        // ── Phase A: media swap ───────────────────────────────────────────────
        if ($image instanceof UploadedFile) {
            $replaced        = $this->mediaService->replace($image, 'products', $product, 'image');
            $data['image']   = $replaced->file_path;
        }

        // ── Phase B: product DB update ────────────────────────────────────────
        try {
            return DB::transaction(fn () => $this->repository->update($product, $data));
        } catch (Throwable $e) {
            // Phase B failed — clean up any media created in Phase A.
            $this->mediaService
                ->findByType($product, 'image')
                ->whereNotIn('id', $preExistingIds)
                ->each(fn ($orphan) => $this->mediaService->delete($orphan));

            throw $e;
        }
    }

    /**
     * Delete a product, removing all associated media files first.
     */
    public function delete(Product $product): bool
    {
        try {
            $this->mediaService->deleteByType($product, 'image');
        } catch (Throwable $e) {
            report($e);
        }

        return DB::transaction(fn () => $this->repository->delete($product));
    }

    /**
     * Toggle a product's active status.
     */
    public function toggleActive(Product $product): Product
    {
        $product->update(['is_active' => ! $product->is_active]);

        return $product;
    }
}
