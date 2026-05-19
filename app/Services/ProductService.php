<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductRepository;

class ProductService
{
    public function __construct(
        protected ProductRepository $repository
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
     * Create a new product.
     *
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): Product
    {
        return $this->repository->create($data);
    }

    /**
     * Update a product.
     *
     * @param  array<string, mixed>  $data
     */
    public function update(Product $product, array $data): Product
    {
        return $this->repository->update($product, $data);
    }

    /**
     * Delete a product.
     */
    public function delete(Product $product): bool
    {
        return $this->repository->delete($product);
    }


    /**
     * Toggle a product's active status.
     */
    public function toggleActive(Product $product): Product
    {
        $product->update(['is_active' => !$product->is_active]);

        return $product;
    }
}
