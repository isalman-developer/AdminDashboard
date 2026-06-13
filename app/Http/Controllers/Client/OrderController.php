<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function thankyou(string $orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)->with('items')->firstOrFail();

        return view('client.orders.thankyou', compact('order'));
    }

    public function track()
    {
        return view('client.orders.track');
    }

    public function trackOrder(Request $request)
    {
        $request->validate([
            'order_number' => 'required|string',
            'email'        => 'required|email',
        ]);

        $result = Order::where('order_number', $request->order_number)
            ->where('customer_email', $request->email)
            ->with('items')
            ->first();

        if (! $result) {
            $error = 'No order found matching that order number and email address.';
            return view('client.orders.track', compact('error'));
        }

        return view('client.orders.track', compact('result'));
    }
}
