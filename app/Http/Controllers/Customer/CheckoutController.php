<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    //
    public function index()
    {
        $cart = Cart::with('items.product')
            ->where('user_id', Auth::id())
            ->first();

        if (! $cart || $cart->items->count() == 0) {
            return redirect()
                ->route('customer.cart')
                ->with('error', 'Keranjang Anda kosong.');
        }

        $subtotal = $cart->items->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('customer.checkout', compact('cart', 'subtotal'));
    }

    public function process(Request $request)
    {
        $userId = Auth::id();

        $cart = Cart::with('items.product')
            ->where('user_id', $userId)
            ->first();

        if (! $cart || $cart->items->isEmpty()) {
            return redirect()->route('customer.cart')
                ->with('error', 'Keranjang Anda kosong.');
        }

        DB::transaction(function () use ($cart, $userId) {

            $order = Order::create([
                'user_id' => $userId,
                'total_price' => $cart->items->sum(fn ($item) => $item->product->price * $item->quantity
                ),
                'status' => 'pending',
            ]);

            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'price' => $item->product->price,
                    'quantity' => $item->quantity,
                ]);
            }

            $cart->items()->delete();
        });

        return redirect()->route('customer.order')
            ->with('success', 'Pesanan berhasil dibuat dan menunggu konfirmasi admin ✅');
    }
}
