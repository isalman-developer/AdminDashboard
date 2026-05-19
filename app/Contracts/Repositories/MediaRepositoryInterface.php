<?php

namespace App\Contracts\Repositories;

use App\Models\Media;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

interface MediaRepositoryInterface
{
    public function find(int $id): ?Media;
    public function create(UploadedFile $file, string $folder, Model $model, string $fileType = 'default'): Media;
    public function replace(UploadedFile $file, string $folder, Model $model, string $fileType): Media;
    public function findLatestOfType(Model $model, string $fileType): ?Media;
    public function findByType(Model $model, string $fileType): Collection;
    public function delete(Media $media): bool;
    public function forModel(Model $model): Collection;
}
