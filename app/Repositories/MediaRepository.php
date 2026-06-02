<?php

namespace App\Repositories;

use App\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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
     * Store the uploaded file under storage/app/public/{folder}/ and
     * create the matching media record.
     *
     * The stored file_path is relative to the public disk root,
     * e.g. "avatars/abc123.jpg". Access it via:
     *   Storage::url($media->file_path)  → /storage/avatars/abc123.jpg
     *   asset('storage/' . $media->file_path) → same result
     */
    public function create(UploadedFile $file, string $folder, Model $model, string $fileType = 'default'): Media
    {
        $fileName = $this->makeFileName($file);
        $path     = $this->storeInStorage($folder, $fileName, $file);

        return Media::create([
            'file_name'     => $fileName,
            'file_path'     => $path,
            'mime_type'     => $file->getMimeType(),
            'file_type'     => $fileType,
            'mediable_type' => $model->getMorphClass(),
            'mediable_id'   => $model->getKey(),
        ]);
    }

    /**
     * Replace all existing media of the given file_type for a model.
     * Old physical files and DB records are removed first.
     */
    public function replace(UploadedFile $file, string $folder, Model $model, string $fileType): Media
    {
        foreach ($this->findByType($model, $fileType) as $old) {
            $this->maybeDelete($old);
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
     * Delete a single media record and its physical file from storage.
     */
    public function delete(Media $media): bool
    {
        $this->maybeDelete($media);

        return (bool) $media->delete();
    }

    /**
     * List all media belonging to a model.
     */
    public function forModel(Model $model)
    {
        return $model->media()->get();
    }

    // -------------------------------------------------------------------------
    // Private helpers
    // -------------------------------------------------------------------------

    private function storeInStorage(string $folder, string $fileName, UploadedFile $file): string
    {
        // storeAs on the 'public' disk puts the file in storage/app/public/{folder}/{fileName}
        // and returns the path relative to the disk root: "{folder}/{fileName}"
        return $file->storeAs($folder, $fileName, 'public');
    }

    /**
     * Build a cryptographically random file name preserving the original extension.
     */
    private function makeFileName(UploadedFile $file): string
    {
        return strtolower(Str::random(40) . '.' . $file->getClientOriginalExtension());
    }

    /**
     * Delete the physical file from the 'public' storage disk if it exists.
     */
    private function maybeDelete(Media $media): void
    {
        if (Storage::disk('public')->exists($media->file_path)) {
            Storage::disk('public')->delete($media->file_path);
        }
    }
}
