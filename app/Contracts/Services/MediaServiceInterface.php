<?php

namespace App\Contracts\Services;

use App\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

interface MediaServiceInterface
{
    public function upload(UploadedFile $file, string $folder, Model $model, string $fileType = 'default'): Media;
    public function replace(UploadedFile $file, string $folder, Model $model, string $fileType): Media;
    public function deleteByType(Model $model, string $fileType): int;
    public function delete(Media $media): bool;
}
