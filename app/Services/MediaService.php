<?php

namespace App\Services;

use App\Models\Media;
use App\Repositories\MediaRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class MediaService
{
    public function __construct(
        protected MediaRepository $repository
    ) {}

    public function upload(UploadedFile $file, string $folder, Model $model, string $fileType = 'default'): Media
    {
        return $this->repository->create($file, $folder, $model, $fileType);
    }

    public function replace(UploadedFile $file, string $folder, Model $model, string $fileType): Media
    {
        $this->deleteByType($model, $fileType);

        return $this->upload($file, $folder, $model, $fileType);
    }

    public function deleteByType(Model $model, string $fileType): int
    {
        $records = $this->repository->findByType($model, $fileType);
        $count = 0;

        foreach ($records as $record) {
            $this->repository->delete($record);
            $count++;
        }

        return $count;
    }

    public function findByType(Model $model, string $fileType): Collection
    {
        return $this->repository->findByType($model, $fileType);
    }

    public function delete(Media $media): bool
    {
        return $this->repository->delete($media);
    }
}
