<?php

namespace App\Services;

use App\Contracts\Services\CategoryServiceInterface;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class CategoryService implements CategoryServiceInterface
{
    public function __construct(
        protected CategoryRepository $repository
    ) {}

    /**
     * Paginate categories with optional search.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator<int, Category>
     */
    public function paginate(string $search = '', int $perPage = 10)
    {
        return $this->repository->paginate($search, $perPage);
    }

    /**
     * Find a category by ID.
     */
    public function find(int $id): ?Category
    {
        return $this->repository->find($id);
    }

    /**
     * Find a category by slug.
     */
    public function findBySlug(string $slug): ?Category
    {
        return $this->repository->findBySlug($slug);
    }

    /**
     * Find a category with its products.
     */
    public function findWithProducts(int $id): ?Category
    {
        return $this->repository->findWithProducts($id);
    }

    /**
     * Create a new category.
     *
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): Category
    {
        return $this->repository->create($data);
    }

    /**
     * Update a category.
     *
     * @param  array<string, mixed>  $data
     */
    public function update(Category $category, array $data): Category
    {
        return $this->repository->update($category, $data);
    }

    /**
     * Delete a category.
     */
    public function delete(Category $category): bool
    {
        return $this->repository->delete($category);
    }

    /**
     * Return all categories ordered by name — cache-backed.
     * Cached for 10 minutes; automatically flushed by CategoryObserver
     * on create / update / delete.
     *
     * @return \Illuminate\Support\Collection<int, Category>
     */
    public function allOrdered(): Collection
    {
        return Cache::remember('categories.ordered', 600, function () {
            return $this->repository->allOrdered();
        });
    }

    /**
     * Clear the allOrdered cache.
     */
    public function flushCache(): void
    {
        Cache::forget('categories.ordered');
    }
}
