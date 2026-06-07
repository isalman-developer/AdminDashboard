<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MarkedAs;
use App\Models\Product;
use App\Models\SiteSetting;
use App\Models\Slider;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $brands = Cache::remember('brands.client', 600, function () {
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

        $markedAs = Cache::remember('marked_as.client', 600, function () {
            return MarkedAs::all()
                ->map(fn ($item) => [
                    'id'    => $item->id,
                    'name'  => $item->name,
                    'slug'  => str($item->name)->slug(),
                    'title' => $item->name,
                ])
                ->all();
        });

        $categories = Cache::remember('categories.client', 600, function () {
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

        $siteSettings = Cache::remember('site_settings.client', 600, function () {
            return SiteSetting::all()
                ->map(fn ($item) => $item->only(['id', 'name', 'address', 'phone_number_1', 'phone_number_2', 'email_1', 'email_2', 'faceboook', 'instagram', 'linkedin', 'twitter']))
                ->all();
        });

        $data['normal_products'] = Product::with('media')->whereStatus(true)->where('marked_as_id', 1)
            ->inRandomOrder()->take(10)->get();

        $data['featured_products'] = Product::with('media')->whereStatus(true)->where('marked_as_id', 2)
            ->inRandomOrder()->take(6)->get();

        $data['best_seller_products'] = Product::with('media')->whereStatus(true)->where('marked_as_id', 3)
            ->inRandomOrder()->take(6)->get();

        $data['sale_item_products'] = Product::with('media')->whereStatus(true)->where('marked_as_id', 4)
            ->inRandomOrder()->take(2)->get();

        $data['top_rated_products'] = Product::with('media')->whereStatus(true)->where('marked_as_id', 5)
            ->inRandomOrder()->take(6)->get();

        $data['top_deal_products'] = Product::with('media')->whereStatus(true)->where('marked_as_id', 6)
            ->inRandomOrder()->take(6)->get();

        $sliders = [];

        return view('client.index', compact('data', 'sliders', 'brands', 'markedAs', 'categories', 'siteSettings'));
    }

    public function aboutUs()
    {
        $brands = Cache::remember('brands.client', 600, function () {
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

        $markedAs = Cache::remember('marked_as.client', 600, function () {
            return MarkedAs::all()
                ->map(fn ($item) => [
                    'id'    => $item->id,
                    'name'  => $item->name,
                    'slug'  => str($item->name)->slug(),
                    'title' => $item->name,
                ])
                ->all();
        });

        $categories = Cache::remember('categories.client', 600, function () {
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

        $siteSettings = Cache::remember('site_settings.client', 600, function () {
            return SiteSetting::all()
                ->map(fn ($item) => $item->only(['id', 'name', 'address', 'phone_number_1', 'phone_number_2', 'email_1', 'email_2', 'faceboook', 'instagram', 'linkedin', 'twitter']))
                ->all();
        });

        return view('client.about-us.about-us', compact('brands', 'markedAs', 'categories', 'siteSettings'));
    }

    public function contactUs()
    {
        $brands = Cache::remember('brands.client', 600, function () {
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

        $markedAs = Cache::remember('marked_as.client', 600, function () {
            return MarkedAs::all()
                ->map(fn ($item) => [
                    'id'    => $item->id,
                    'name'  => $item->name,
                    'slug'  => str($item->name)->slug(),
                    'title' => $item->name,
                ])
                ->all();
        });

        $categories = Cache::remember('categories.client', 600, function () {
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

        $siteSettings = Cache::remember('site_settings.client', 600, function () {
            return SiteSetting::all()
                ->map(fn ($item) => $item->only(['id', 'name', 'address', 'phone_number_1', 'phone_number_2', 'email_1', 'email_2', 'faceboook', 'instagram', 'linkedin', 'twitter']))
                ->all();
        });

        return view('client.contact-us.contact-us', compact('brands', 'markedAs', 'categories', 'siteSettings'));
    }
}
