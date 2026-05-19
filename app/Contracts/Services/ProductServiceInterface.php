<?php

namespace App\Contracts\Services;

use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductServiceInterface
{
    public function paginate(string $search = '', ?int $categoryId = null, int $perPage = 10): LengthAwarePaginator;
    public function find(int $id): ?Product;
    public function findBySlug(string $slug): ?Product;
    public function findBySku(string $sku): ?Product;
    public function create(array $data): Product;
    public function update(Product $product, array $data): Product;
    public function delete(Product $product): bool;
    public function toggleActive(Product $product): Product;
}
