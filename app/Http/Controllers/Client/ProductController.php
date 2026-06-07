<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::whereStatus(true)
            ->with(['brand', 'media'])
            ->when(request()->input('marked_as_id'), function ($query) {
                $query->where('marked_as_id', request()->input('marked_as_id'));
            })->paginate(12);

        return view('client.products.listing', compact('products'));
    }

    public function show(Product $product)
    {
        $product->load('media');
        return view('client.products.show', compact('product'));
    }
}
