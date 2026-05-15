<?php

namespace App\Services;

use App\Models\Media;
use App\Repositories\MediaRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class MediaService
{
    public function __construct(
        protected MediaRepository $repository
    ) {}

    /**
     * Upload a file and attach it to a morphable model.
     */
    public function upload(UploadedFile $file, string $folder, Model $model, string $fileType = 'default'): Media
    {
        return $this->repository->create($file, $folder, $model, $fileType);
    }

    /**
     * Replace the current file of a given file_type for a model.
     * Old files (physical + DB) are removed first, then the new one is stored.
     */
    public function replace(UploadedFile $file, string $folder, Model $model, string $fileType): Media
    {
        $this->deleteByType($model, $fileType);

        return $this->upload($file, $folder, $model, $fileType);
    }

    /**
     * Delete all media records of a given file_type for a model.
     *
     * @return int Number of records deleted.
     */
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

    /**
     * Delete a single media record and its physical file.
     */
    public function delete(Media $media): bool
    {
        return $this->repository->delete($media);
    }
}
