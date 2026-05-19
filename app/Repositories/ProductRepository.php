<?php

namespace App\Repositories;

use App\Contracts\Repositories\ProductRepositoryInterface;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    protected function model(): string
    {
        return Product::class;
    }

    /** @return LengthAwarePaginator<int, Product> */
    public function paginate(
        string $search = '',
        ?int $categoryId = null,
        int $perPage = 10
    ): LengthAwarePaginator {
        return Product::when($search, function ($query) use ($search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('sku', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        })
            ->when($categoryId, fn ($q) => $q->where('category_id', $categoryId))
            ->with('category')
            ->orderBy('name', 'asc')
            ->paginate($perPage)
            ->withQueryString();
    }

    public function findBySlug(string $slug): ?Product
    {
        return Product::where('slug', $slug)->first();
    }

    public function findBySku(string $sku): ?Product
    {
        return Product::where('sku', $sku)->first();
    }
}
