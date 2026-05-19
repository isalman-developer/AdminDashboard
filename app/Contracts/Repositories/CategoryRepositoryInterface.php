<?php

namespace App\Contracts\Repositories;

use App\Models\Category;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface CategoryRepositoryInterface
{
    public function paginate(string $search = '', int $perPage = 10): LengthAwarePaginator;
    public function find(int $id): ?Category;
    public function findBySlug(string $slug): ?Category;
    public function findWithProducts(int $id): ?Category;
    public function create(array $data): Category;
    public function update(Category $category, array $data): Category;
    public function delete(Category $category): bool;
    public function allOrdered(): Collection;
}
