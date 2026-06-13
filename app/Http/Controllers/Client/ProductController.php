<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active', true)
            ->with(['brand', 'media' => fn ($q) => $q->where('file_type', 'image')])
            ->when(request()->input('marked_as_id'), function ($query) {
                $query->where('marked_as_id', request()->input('marked_as_id'));
            })->paginate(12);

        $brands = Brand::orderBy('name')->get();

        return view('client.products.listing', compact('products', 'brands'));
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
