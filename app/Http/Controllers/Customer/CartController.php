<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function increase(CartItem $cartItem)
    {
        $product = $cartItem->product;

        if ($product->stock <= 0) {
            return redirect()->back()->with('error', 'Stok produk tidak mencukupi');
        }

        // nambah stok
        $cartItem->increment('quantity');

        // kurang stok produk
        $product->decrement('stock');

    }

    public function decrease(CartItem $cartItem)
    {
        $product = $cartItem->product;

        if ($cartItem->quantity > 1) {
            // hapus item dari cart
            $cartItem->decrement('quantity');

            $product->increment('stock');
        } else {
            // kurangin quantity
            $cartItem->increment('stock');
            $cartItem->delete();
        }

        return back();

    }

    public function index()
    {
        $cart = Cart::with('items.product')->where('user_id', Auth::id())->first();

        $subtotal = 0;

        if ($cart) {
            foreach ($cart->items as $item) {
                $subtotal += $item->product->price * $item->quantity;
            }
        }

        return view('customer.cart', compact('cart' , 'subtotal'));
    }

    public function addToCart($productId)
    {
        $user = Auth::user();
        $product = Product::findOrFail($productId);

        $cart = Cart::firstOrCreate(
            ['user_id' => $user->id]
        );

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'quantity' => 1,
            ]);
        }

        return redirect()->route('customer.cart')->with('success', 'Produk ditambahkan ke keranjang');
    }
}
