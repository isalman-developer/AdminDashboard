<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{

    public function index()
    {
        $request = request();

        $query = Product::where('is_active', true)
            ->with([
                'brand',
                'category',
                'media' => fn ($q) => $q->where('file_type', 'image'),
            ])
            ->when($request->filled('brand_id'), fn ($q) =>
                $q->whereIn('brand_id', $request->brand_id))
            ->when($request->filled('category_id'), fn ($q) =>
                $q->whereIn('category_id', $request->category_id))
            ->when($request->filled('price_min'), fn ($q) =>
                $q->where('price', '>=', (float) $request->price_min))
            ->when($request->filled('price_max'), fn ($q) =>
                $q->where('price', '<=', (float) $request->price_max));




        match ($request->input('sort_by', 'newest')) {
            'price_asc' => $query->orderBy('price', 'asc'),

            'price_desc' => $query->orderBy('price', 'desc'),
            'name_asc' => $query->orderBy('name', 'asc'),
            'name_desc' => $query->orderBy('name', 'desc'),
            default => $query->latest(),
        };

        $products = $query
            ->paginate(config('admin.pagination_per_page'))
            ->withQueryString();

        $priceRange = [
            'min' => (int) Product::where('is_active', true)->min('price') ?? 0,
            'max' => (int) Product::where('is_active', true)->max('price') ?? 9999,
        ];

        $brands = Brand::orderBy('name')->get();

        $categories = Category::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('client.products.listing', compact('products', 'brands', 'categories', 'priceRange'));
    }


    public function show(Product $product)
    {
        $product->load([
            'media'    => fn ($q) => $q->where('file_type', 'image'),
            'brand',
            'category',
        ]);

        $related = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->with([
                'media' => fn ($q) => $q->where('file_type', 'image'),
                'brand',
            ])
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('client.products.show', compact('product', 'related'));
    }
}
