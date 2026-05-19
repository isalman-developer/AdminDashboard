<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class CategoryRepository
{
    /**
     * Paginate categories with optional search.
     *
     * @return LengthAwarePaginator<int, Category>
     */
    public function paginate(string $search = '', int $perPage = 10): LengthAwarePaginator
    {
        return Category::when($search, function ($query) use ($search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('slug', 'like', "%{$search}%");
        })
            ->orderBy('name', 'asc')
            ->paginate($perPage)
            ->withQueryString();
    }

    /**
     * Find a category by primary key.
     */
    public function find(int $id): ?Category
    {
        return Category::find($id);
    }

    /**
     * Find a category by slug.
     */
    public function findBySlug(string $slug): ?Category
    {
        return Category::where('slug', $slug)->first();
    }

    /**
     * Find a category by ID with products loaded.
     */
    public function findWithProducts(int $id): ?Category
    {
        return Category::with('products')->find($id);
    }

    /**
     * Create a new category.
     *
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): Category
    {
        return Category::create($data);
    }

    /**
     * Update a category.
     *
     * @param  array<string, mixed>  $data
     */
    public function update(Category $category, array $data): Category
    {
        $category->update($data);

        return $category;
    }

    /**
     * Delete a category.
     */
    public function delete(Category $category): bool
    {
        try {
            return $category->delete();
        } catch (\Exception) {
            return false;
        }
    }

    /**
     * Return all categories ordered by name, cached until invalidated by the observer.
     *
     * @return Collection<int, Category>
     */
    public function allOrdered(): Collection
    {
        return Cache::rememberForever('categories.ordered', fn () =>
            Category::orderBy('name', 'asc')->get()
        );
    }
}
