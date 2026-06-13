<?php

use App\Models\Brand;
use App\Models\Category;
use App\Models\MarkedAs;
use App\Models\Setting;
use App\Models\Slider;
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
            $s = Setting::pluck('value', 'key');

            return [[
                'name'           => $s->get('site_name', ''),
                'address'        => $s->get('site_address', ''),
                'phone_number_1' => $s->get('site_phone_1', ''),
                'phone_number_2' => $s->get('site_phone_2', ''),
                'email_1'        => $s->get('site_email_1', ''),
                'email_2'        => $s->get('site_email_2', ''),
                'faceboook'      => $s->get('site_facebook', ''),
                'instagram'      => $s->get('site_instagram', ''),
                'linkedin'       => $s->get('site_linkedin', ''),
                'twitter'        => $s->get('site_twitter', ''),
            ]];
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

if (! function_exists('site_sliders')) {
    function site_sliders(): \Illuminate\Support\Collection
    {
        return Cache::remember('sliders.client', 600, function () {
            return Slider::where('status', true)->with('media')->orderByDesc('id')->get();
        });
    }
}
