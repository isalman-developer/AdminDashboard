<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $data['normal_products'] = Product::with('files')->whereStatus(true)->where('marked_as_id', 1)
            ->inRandomOrder()->take(10)->get();

        $data['random_products'] = Product::with('files')->whereStatus(true)->where('marked_as_id', 1)
            ->inRandomOrder()->take(5)->get();

        $data['featured_products'] = Product::with('files')->whereStatus(true)->where('marked_as_id', 2)
            ->inRandomOrder()->take(6)->get();

        $data['best_seller_products'] = Product::with('files')->whereStatus(true)->where('marked_as_id', 3)
            ->inRandomOrder()->take(6)->get();

        $data['sale_item_products'] = Product::with('files')->whereStatus(true)->where('marked_as_id', 4)
            ->inRandomOrder()->take(2)->get();

        $data['top_rated_products'] = Product::with('files')->whereStatus(true)->where('marked_as_id', 5)
            ->inRandomOrder()->take(6)->get();

        $data['top_deal_products'] = Product::with('files')->whereStatus(true)->where('marked_as_id', 6)
            ->inRandomOrder()->take(6)->get();

        $data['primary_products'] = Product::with('files')->whereStatus(true)->where('marked_as_id', 8)
            ->inRandomOrder()->take(2)->get();

        $data['grand_sale_product'] = Product::with('files')->whereStatus(true)->where('marked_as_id', 9)
            ->inRandomOrder()->take(6)->get();

        return view('client.index', compact('data',));
    }

    public function aboutUs()
    {
        return view('client.about-us.about-us');
    }

    public function contactUs()
    {
        return view('client.contact-us.contact-us');
    }
}
