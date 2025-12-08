<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;



class CheckoutController extends Controller
{
    //
    public function index()
    {
        $cart = Cart::with('items.product')
            ->where('user_id', Auth::id() )
            ->first();

        if (!$cart || $cart->items->count() == 0) {
            return redirect()
                ->route('cart')
                ->with('error', 'Keranjang Anda kosong.');
        }

        $subtotal = $cart->items->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('checkout.index', compact('cart', 'subtotal'));
    }
    public function process(Request $request)
    {
        // 
        $userId = Auth::id();
        $cart = Cart::with('items.product')
            ->where('user_id', $userId)
            ->first();

        if (!$cart || $cart->items->isEmpty()){
            return redirect()->route('cart')
                ->with('error', 'Keranjang Anda kosong.');
                
        }
        $order = Order::create([
            'user_id' => $userId,
            'total_price' => $cart->items->sum(function ($item) {
                return $item->product->price * $item->quantity;
            }),
        ]);
        foreach($cart->items as $item){
            OrderItem::create ([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }
        $cart->items()->delete();
        return redirect()->route('orders.index')
            ->with('success', 'Pesanan Anda telah diproses.');
    }
}
