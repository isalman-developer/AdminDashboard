<?php

namespace App\Services;

use App\Models\Brand;
use App\Repositories\BrandRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Throwable;

class BrandService
{
    public function __construct(
        protected BrandRepository $repository,
        protected MediaService $mediaService
    ) {}

    /** @return LengthAwarePaginator<int, Brand> */
    public function paginate(string $search = '', int $perPage = 10): LengthAwarePaginator
    {
        return $this->repository->paginate($search, $perPage);
    }

    public function find(int $id): ?Brand
    {
        return $this->repository->find($id);
    }

    public function findBySlug(string $slug): ?Brand
    {
        return $this->repository->findBySlug($slug);
    }

    public function findWithProducts(int $id): ?Brand
    {
        return $this->repository->findWithProducts($id);
    }

    /** @param array<string, mixed> $data */
    public function create(array $data): Brand
    {
        $logo = $data['logo'] ?? null;
        unset($data['logo']);

        return DB::transaction(function () use ($data, $logo): Brand {
            $brand = $this->repository->create($data);

            if ($logo instanceof UploadedFile) {
                $this->mediaService->upload($logo, 'brands', $brand, 'logo');
            }

            return $brand;
        });
    }

    /** @param array<string, mixed> $data */
    public function update(Brand $brand, array $data): Brand
    {
        $logo = $data['logo'] ?? null;
        unset($data['logo']);

        $preExistingIds = $this->mediaService->findByType($brand, 'logo')->pluck('id')->all();

        if ($logo instanceof UploadedFile) {
            $replaced = $this->mediaService->replace($logo, 'brands', $brand, 'logo');
            $data['logo'] = $replaced->file_path;
        }

        try {
            return DB::transaction(fn () => $this->repository->update($brand, $data));
        } catch (Throwable $e) {
            $this->mediaService
                ->findByType($brand, 'logo')
                ->whereNotIn('id', $preExistingIds)
                ->each(fn ($orphan) => $this->mediaService->delete($orphan));

            throw $e;
        }
    }

    public function delete(Brand $brand): bool
    {
        try {
            $this->mediaService->deleteByType($brand, 'logo');
        } catch (Throwable $e) {
            report($e);
        }

        if ($this->repository->hasProducts($brand)) {
            return false;
        }

        return DB::transaction(fn () => $this->repository->delete($brand));
    }

    /** @return Collection<int, Brand> */
    public function allOrdered(): Collection
    {
        return Cache::remember('brands.ordered', 600, function () {
            return $this->repository->allOrdered();
        });
    }

    public function flushCache(): void
    {
        Cache::forget('brands.ordered');
    }
}
