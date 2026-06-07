<?php

namespace App\Repositories;

use App\Models\Brand;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class BrandRepository extends BaseRepository
{
    protected function model(): string
    {
        return Brand::class;
    }

    /** @return LengthAwarePaginator<int, Brand> */
    public function paginate(string $search = '', int $perPage = 10): LengthAwarePaginator
    {
        return Brand::when($search, function ($query) use ($search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('slug', 'like', "%{$search}%");
        })
            ->orderBy('name', 'asc')
            ->paginate($perPage)
            ->withQueryString();
    }

    public function findBySlug(string $slug): ?Brand
    {
        return Brand::where('slug', $slug)->first();
    }

    public function findWithProducts(int $id): ?Brand
    {
        return Brand::with('products')->find($id);
    }

    public function hasProducts(Brand $brand): bool
    {
        return $brand->products()->exists();
    }

    /** @return Collection<int, Brand> */
    public function allOrdered(): Collection
    {
        return Brand::orderBy('name', 'asc')->get();
    }
}
