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
        return $this->repository->find($id)?->load('category', 'brand');
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

    public function update(Product $product, array $data): Product
    {
        $image = $data['image'] ?? null;
        unset($data['image']);

        $preExistingIds = $this->mediaService->findByType($product, 'image')->pluck('id')->all();

        if ($image instanceof UploadedFile) {
            $replaced = $this->mediaService->replace($image, 'products', $product, 'image');
            $data['image'] = $replaced->file_path;
        }

        try {
            return DB::transaction(fn () => $this->repository->update($product, $data));
        } catch (Throwable $e) {
            $this->mediaService
                ->findByType($product, 'image')
                ->whereNotIn('id', $preExistingIds)
                ->each(fn ($orphan) => $this->mediaService->delete($orphan));

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
