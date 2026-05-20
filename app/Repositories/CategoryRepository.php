<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CategoryRepository extends BaseRepository
{
    protected function model(): string
    {
        return Category::class;
    }

    /** @return LengthAwarePaginator<int, Category> */
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

    public function findBySlug(string $slug): ?Category
    {
        return Category::where('slug', $slug)->first();
    }

    public function findWithProducts(int $id): ?Category
    {
        return Category::with('products')->find($id);
    }

    public function hasProducts(Category $category): bool
    {
        return $category->products()->exists();
    }

    /** @return Collection<int, Category> */
    public function allOrdered(): Collection
    {
        return Category::orderBy('name', 'asc')->get();
    }
}
