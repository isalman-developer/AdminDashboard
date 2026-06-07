<?php

namespace App\Services;

use App\Models\Slider;
use App\Repositories\SliderRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class SliderService
{
    public function __construct(
        protected SliderRepository $repository,
        protected MediaService $mediaService
    ) {}

    public function paginate(string $search = '', int $perPage = 10)
    {
        return $this->repository->paginate($search, $perPage);
    }

    public function create(array $data): Slider
    {
        $image = $data['image'] ?? null;
        unset($data['image']);

        return DB::transaction(function () use ($data, $image) {
            $slider = $this->repository->create($data);

            if ($image instanceof UploadedFile) {
                $this->mediaService->upload($image, 'sliders', $slider, 'image');
            }

            return $slider;
        });
    }

    public function update(Slider $slider, array $data): Slider
    {
        $image = $data['image'] ?? null;
        unset($data['image']);

        $preExistingIds = $this->mediaService
            ->findByType($slider, 'image')
            ->pluck('id')
            ->all();

        if ($image instanceof UploadedFile) {
            $replaced = $this->mediaService->replace($image, 'sliders', $slider, 'image');
            $data['image'] = $replaced->file_path;
        }

        try {
            return DB::transaction(fn () => $this->repository->update($slider, $data));
        } catch (\Throwable $e) {
            $this->mediaService
                ->findByType($slider, 'image')
                ->whereNotIn('id', $preExistingIds)
                ->each(fn ($item) => $this->mediaService->delete($item));

            throw $e;
        }
    }

    public function delete(Slider $slider): bool
    {
        try {
            $this->mediaService->deleteByType($slider, 'image');
        } catch (\Throwable $e) {
            report($e);
        }

        return DB::transaction(fn () => $this->repository->delete($slider));
    }
}
