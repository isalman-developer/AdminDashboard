<?php

namespace App\Repositories;

use App\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class MediaRepository
{
    /**
     * Find a media record by ID.
     */
    public function find(int $id): ?Media
    {
        return Media::find($id);
    }

    /**
     * Store the uploaded file under public/uploads/{folder}/ and
     * create the matching media record using the correct
     * mediable_type / mediable_id columns from the migration.
     */
    public function create(UploadedFile $file, string $folder, Model $model, string $fileType = 'default'): Media
    {
        $mimeType = $file->getMimeType();
        $fileName = $this->makeFileName($file);
        $path = $this->storeInPublic($folder, $fileName, $file);

        return Media::create([
            'file_name' => $fileName,
            'file_path' => $path,
            'mime_type' => $mimeType,
            'file_type' => $fileType,
            'mediable_type' => $model->getMorphClass(),
            'mediable_id' => $model->getKey(),
        ]);
    }

    /**
     * Replace all existing media of the given file_type for a model.
     * Old physical files and DB records are removed first.
     */
    public function replace(UploadedFile $file, string $folder, Model $model, string $fileType): Media
    {
        foreach ($this->findByType($model, $fileType) as $old) {
            $this->maybeUnlink($old);
            $old->delete();
        }

        return $this->create($file, $folder, $model, $fileType);
    }

    /**
     * Find the latest media record of a given file_type for a model.
     */
    public function findLatestOfType(Model $model, string $fileType): ?Media
    {
        return $model->media()
            ->where('file_type', $fileType)
            ->latest('id')
            ->first();
    }

    /**
     * Get all media records of a given file_type for a model.
     */
    public function findByType(Model $model, string $fileType)
    {
        return $model->media()
            ->where('file_type', $fileType)
            ->get();
    }

    /**
     * Delete a single media record and its physical file.
     */
    public function delete(Media $media): bool
    {
        $this->maybeUnlink($media);

        return (bool) $media->delete();
    }

    /**
     * List all media belonging to a model.
     */
    public function forModel(Model $model)
    {
        return $model->media()->get();
    }

    /**
     * Store an uploaded file into public/uploads/{folder}/{fileName}
     * and return the *full relative-from-public* path e.g. "uploads/avatars/{fileName}".
     */
    private function storeInPublic(string $folder, string $fileName, UploadedFile $file): string
    {
        $fullPath = public_path("uploads/{$folder}/{$fileName}");
        $dir = dirname($fullPath);

        if (! is_dir($dir)) {
            mkdir($dir, 0775, true);
        }

        $file->move($dir, $fileName);

        return "uploads/{$folder}/{$fileName}";
    }

    /**
     * Build a unique file name preserving the original extension.
     */
    private function makeFileName(UploadedFile $file): string
    {
        return strtolower(Str::random(40).'.'.$file->getClientOriginalExtension());
    }

    /**
     * Remove the physical file only if it still exists on disk.
     */
    private function maybeUnlink(Media $media): void
    {
        $path = public_path($media->file_path);
        if (is_file($path)) {
            @unlink($path);
        }
    }
}
