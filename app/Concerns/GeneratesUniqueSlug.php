<?php

namespace App\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait GeneratesUniqueSlug
{
    private function ensureUniqueSlug(Model $model): void
    {
        $base = Str::slug($model->name) ?: 'unnamed';

        $existing = $model->newQuery()
            ->where('slug', 'like', $base.'%')
            ->when($model->exists, fn ($q) => $q->where('id', '!=', $model->id))
            ->pluck('slug');

        if ($existing->isEmpty() || ! $existing->contains($base)) {
            $model->slug = $base;

            return;
        }

        $counter = 1;
        while ($existing->contains("{$base}-{$counter}")) {
            $counter++;
        }

        $model->slug = "{$base}-{$counter}";
    }
}
