<?php

namespace App\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait GeneratesUniqueSlug
{
    private function ensureUniqueSlug(Model $model): void
    {
        $base = Str::slug($model->name) ?: 'unnamed';
        $slug = $base;
        $counter = 1;

        while (
            $model->newQuery()
                ->where('slug', $slug)
                ->when($model->exists, fn ($q) => $q->where('id', '!=', $model->id))
                ->exists()
        ) {
            $slug = "{$base}-{$counter}";
            $counter++;
        }

        $model->slug = $slug;
    }
}
