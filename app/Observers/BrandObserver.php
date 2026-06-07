<?php

namespace App\Observers;

use App\Concerns\GeneratesUniqueSlug;
use App\Models\Brand;
use Illuminate\Support\Facades\Cache;

class BrandObserver
{
    use GeneratesUniqueSlug;

    public function creating(Brand $brand): void
    {
        $this->flushCache();
        $this->ensureUniqueSlug($brand);
    }

    public function updating(Brand $brand): void
    {
        $this->flushCache();
        if ($brand->isDirty('name')) {
            $this->ensureUniqueSlug($brand);
        }
    }

    public function deleting(Brand $brand): void
    {
        $this->flushCache();
    }

    private function flushCache(): void
    {
        Cache::forget('brands.ordered');
    }
}
