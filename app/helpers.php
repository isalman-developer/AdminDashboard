<?php

use App\Models\MarkedAs;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

if (! function_exists('site_marked_as')) {
    function site_marked_as(): array
    {
        return Cache::remember('marked_as.client', 600, function () {
            return MarkedAs::all()
                ->map(fn ($item) => [
                    'id'    => $item->id,
                    'name'  => $item->name,
                    'slug'  => str($item->name)->slug(),
                    'title' => $item->name,
                ])
                ->all();
        });
    }
}

if (! function_exists('setting')) {
    function setting(string $key, mixed $default = null): mixed
    {
        return Cache::remember('site_settings.raw', 600, function () {
            return Setting::pluck('value', 'key');
        })->get($key, $default);
    }
}
