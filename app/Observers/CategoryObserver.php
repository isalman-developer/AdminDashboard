<?php

namespace App\Observers;

use App\Concerns\GeneratesUniqueSlug;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class CategoryObserver
{
    use GeneratesUniqueSlug;

    public function creating(Category $category): void
    {
        $this->flushCache();
        $this->ensureUniqueSlug($category);
    }

    public function updating(Category $category): void
    {
        $this->flushCache();
        if ($category->isDirty('name')) {
            $this->ensureUniqueSlug($category);
        }
    }

    public function deleting(Category $category): void
    {
        $this->flushCache();
    }

    private function flushCache(): void
    {
        Cache::forget('categories.ordered');
    }
}
