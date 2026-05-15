<?php

namespace App\Observers;

use App\Models\Media;

class MediaObserver
{
    /**
     * Handle the Media "deleted" event — remove the physical file
     * from public/uploads/ so we never leave orphaned files behind.
     */
    public function deleted(Media $media): void
    {
        $this->maybeUnlink($media);
    }

    private function maybeUnlink(Media $media): void
    {
        $path = public_path($media->file_path);
        if (is_file($path)) {
            @unlink($path);
        }
    }
}
