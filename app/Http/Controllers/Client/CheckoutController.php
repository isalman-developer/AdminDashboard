<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    private function totals(array $cart): array
    {
        $subtotal = collect($cart)->sum(fn ($item) => $item['price'] * $item['qty']);
        $shipping = $subtotal >= 100 ? 0 : 10;
        return ['subtotal' => $subtotal, 'shipping' => $shipping, 'total' => $subtotal + $shipping];
    }

    public function index()
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        $totals = $this->totals($cart);

        return view('client.checkout.index', [
            'cartItems' => $cart,
            'subtotal'  => $totals['subtotal'],
            'shipping'  => $totals['shipping'],
            'total'     => $totals['total'],
        ]);
    }

    public function process(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        $request->validate([
            'customer_name'  => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:50',
            'address'        => 'required|string|max:500',
            'city'           => 'required|string|max:100',
            'state'          => 'nullable|string|max:100',
            'zip_code'       => 'nullable|string|max:20',
            'country'        => 'required|string|max:100',
            'payment_method' => 'required|in:cod,credit_card,paypal,gpay',
        ]);

        $totals = $this->totals($cart);

        DB::transaction(function () use ($request, $cart, $totals, &$order) {
            $order = Order::create([
                'order_number'   => 'ORD-' . strtoupper(Str::random(8)),
                'customer_name'  => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'address'        => $request->address,
                'city'           => $request->city,
                'state'          => $request->state,
                'zip_code'       => $request->zip_code,
                'country'        => $request->country,
                'payment_method' => $request->payment_method,
                'payment_status' => 'pending',
                'order_status'   => 'pending',
                'subtotal'       => $totals['subtotal'],
                'shipping'       => $totals['shipping'],
                'total'          => $totals['total'],
                'notes'          => $request->notes,
            ]);

            foreach ($cart as $item) {
                $order->items()->create([
                    'product_id'    => $item['id'],
                    'product_name'  => $item['name'],
                    'product_price' => $item['price'],
                    'quantity'      => $item['qty'],
                    'subtotal'      => $item['price'] * $item['qty'],
                ]);

                Product::where('id', $item['id'])->decrement('stock_quantity', $item['qty']);
            }
        });

        session()->forget('cart');

        return redirect()->route('order.thankyou', $order->order_number);
    }
}
