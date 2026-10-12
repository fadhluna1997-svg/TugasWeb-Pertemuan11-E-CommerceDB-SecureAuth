<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $cart = Cart::firstOrCreate([
            'user_id' => auth()->id(),
        ]);

        $cart->load('items.product');

        return view('cart.index', compact('cart'));
    }

    public function add(Product $product): RedirectResponse
    {
        if ($product->stock < 1) {
            return back()->with('error', 'Stok produk habis.');
        }

        $cart = Cart::firstOrCreate([
            'user_id' => auth()->id(),
        ]);

        $item = $cart->items()
            ->where('product_id', $product->id)
            ->first();

        if ($item) {
            if ($item->quantity >= $product->stock) {
                return back()->with('error', 'Jumlah melebihi stok.');
            }

            $item->increment('quantity');
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->price,
            ]);
        }

        return redirect()
            ->route('cart.index')
            ->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function update(Request $request, CartItem $cartItem): RedirectResponse
    {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        if ($cartItem->cart->user_id !== auth()->id()) {
            abort(403);
        }

        if ($validated['quantity'] > $cartItem->product->stock) {
            return back()->with('error', 'Jumlah melebihi stok produk.');
        }

        $cartItem->update([
            'quantity' => $validated['quantity'],
        ]);

        return back()->with('success', 'Keranjang berhasil diperbarui.');
    }

    public function remove(CartItem $cartItem): RedirectResponse
    {
        if ($cartItem->cart->user_id !== auth()->id()) {
            abort(403);
        }

        $cartItem->delete();

        return back()->with('success', 'Produk dihapus dari keranjang.');
    }
}