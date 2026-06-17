<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
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

        $sliders = site_sliders();

        $categories = Category::where('is_active', true)
            ->with(['products' => function ($q) {
                $q->where('status', true)->with('media')->take(1);
            }])
            ->orderBy('name')
            ->get();

        return view('client.index', compact('data', 'sliders', 'categories'));
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
