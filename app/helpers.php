<?php

use App\Models\Brand;
use App\Models\Category;
use App\Models\MarkedAs;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;

if (! function_exists('site_brands')) {
    function site_brands(): array
    {
        return Cache::remember('brands.client', 600, function () {
            return Brand::query()
                ->with('media')
                ->where('is_active', true)
                ->orderBy('name')
                ->get()
                ->map(fn ($brand) => [
                    'id'    => $brand->id,
                    'name'  => $brand->name,
                    'slug'  => $brand->slug,
                    'title' => $brand->name,
                    'path'  => optional($brand->media->firstWhere('file_type', 'logo'))->file_path ?? '',
                ])
                ->all();
        });
    }
}

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

if (! function_exists('site_categories')) {
    function site_categories(): array
    {
        return Cache::remember('categories.client', 600, function () {
            return Category::where('is_active', true)
                ->orderBy('name')
                ->get()
                ->map(fn ($item) => [
                    'id'    => $item->id,
                    'name'  => $item->name,
                    'slug'  => $item->slug,
                    'title' => $item->name,
                ])
                ->all();
        });
    }
}

if (! function_exists('site_settings')) {
    function site_settings(): array
    {
        return Cache::remember('site_settings.client', 600, function () {
            return SiteSetting::all()
                ->map(fn ($item) => $item->only([
                    'id',
                    'name',
                    'address',
                    'phone_number_1',
                    'phone_number_2',
                    'email_1',
                    'email_2',
                    'faceboook',
                    'instagram',
                    'linkedin',
                    'twitter',
                ]))
                ->all();
        });
    }
}
