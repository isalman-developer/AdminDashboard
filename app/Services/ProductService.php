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

    public function paginate(
        string $search = '',
        ?int $categoryId = null,
        ?int $brandId = null,
        int $perPage = 10
    ) {
        return $this->repository->paginate($search, $categoryId, $brandId, $perPage);
    }

    public function find(int $id): ?Product
    {
        return $this->repository->find($id)?->load('category', 'brand', 'media');
    }

    public function findBySlug(string $slug): ?Product
    {
        return $this->repository->findBySlug($slug);
    }

    public function findBySku(string $sku): ?Product
    {
        return $this->repository->findBySku($sku);
    }

    public function create(array $data): Product
    {
        $images = array_filter($data['images'] ?? [], fn ($f) => $f instanceof UploadedFile);
        unset($data['images']);

        return DB::transaction(function () use ($data, $images): Product {
            $product = $this->repository->create($data);

            foreach ($images as $image) {
                $this->mediaService->upload($image, 'products', $product, 'image');
            }

            return $product;
        });
    }

    public function update(Product $product, array $data): Product
    {
        $images    = array_filter($data['images'] ?? [], fn ($f) => $f instanceof UploadedFile);
        $removeIds = array_map('intval', $data['remove_image_ids'] ?? []);
        unset($data['images'], $data['remove_image_ids']);

        // Delete only media that actually belong to this product
        if (!empty($removeIds)) {
            $product->media()
                ->whereIn('id', $removeIds)
                ->get()
                ->each(fn ($m) => $this->mediaService->delete($m));
        }

        try {
            return DB::transaction(function () use ($product, $data, $images): Product {
                foreach ($images as $image) {
                    $this->mediaService->upload($image, 'products', $product, 'image');
                }

                return $this->repository->update($product, $data);
            });
        } catch (Throwable $e) {
            throw $e;
        }
    }

    public function delete(Product $product): bool
    {
        try {
            $this->mediaService->deleteByType($product, 'image');
        } catch (Throwable $e) {
            report($e);
        }

        return DB::transaction(fn () => $this->repository->delete($product));
    }

    public function toggleActive(Product $product): Product
    {
        return $this->repository->update($product, ['is_active' => ! $product->is_active]);
    }
}
