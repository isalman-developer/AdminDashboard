<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CartController extends Controller
{
    private function totals(array $cart): array
    {
        $subtotal = collect($cart)->sum(fn ($item) => $item['price'] * $item['qty']);
        $shipping = $subtotal >= 100 ? 0 : 10;
        return [
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total'    => $subtotal + $shipping,
        ];
    }

    public function index()
    {
        $cart = session('cart', []);
        $totals = $this->totals($cart);

        return view('client.cart.index', [
            'cartItems' => $cart,
            'subtotal'  => $totals['subtotal'],
            'shipping'  => $totals['shipping'],
            'total'     => $totals['total'],
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty'        => 'required|integer|min:1',
        ]);

        $product = Product::with(['media' => fn ($q) => $q->where('file_type', 'image')])->findOrFail($request->product_id);

        $image = $product->media->first()
            ? Storage::url($product->media->first()->file_path)
            : asset('client/images/product/product-img-1.jpg');

        $cart = session('cart', []);
        $id   = $product->id;

        if (isset($cart[$id])) {
            $cart[$id]['qty'] += (int) $request->qty;
        } else {
            $cart[$id] = [
                'id'    => $id,
                'name'  => $product->name,
                'price' => (float) $product->price,
                'qty'   => (int) $request->qty,
                'image' => $image,
            ];
        }

        session(['cart' => $cart]);

        return redirect()->back()->with('success', '"' . $product->name . '" added to cart.');
    }

    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'qty'        => 'required|integer|min:1',
        ]);

        $cart = session('cart', []);
        $id   = $request->product_id;

        if (isset($cart[$id])) {
            $cart[$id]['qty'] = (int) $request->qty;
            session(['cart' => $cart]);
        }

        return redirect()->back();
    }

    public function remove(Request $request)
    {
        $request->validate(['product_id' => 'required|integer']);

        $cart = session('cart', []);
        unset($cart[$request->product_id]);
        session(['cart' => $cart]);

        return redirect()->back()->with('success', 'Item removed from cart.');
    }
}
