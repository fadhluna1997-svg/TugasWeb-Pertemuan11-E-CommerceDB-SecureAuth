<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function create(): View
    {
        $cart = Cart::firstOrCreate([
            'user_id' => auth()->id(),
        ]);

        $cart->load('items.product');

        if ($cart->items->isEmpty()) {
            return view('orders.checkout', [
                'cart' => $cart,
                'total' => 0,
            ]);
        }

        $total = $cart->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        return view('orders.checkout', compact('cart', 'total'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'shipping_address' => ['required', 'string', 'max:255'],
        ]);

        $cart = Cart::with('items.product')
            ->where('user_id', auth()->id())
            ->first();

        if (! $cart || $cart->items->isEmpty()) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Keranjang masih kosong.');
        }

        $total = $cart->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        DB::transaction(function () use ($cart, $validated, $total) {
            $order = Order::create([
                'user_id' => auth()->id(),
                'total_amount' => $total,
                'status' => 'pending',
                'shipping_address' => $validated['shipping_address'],
            ]);

            foreach ($cart->items as $item) {
                $order->items()->create([
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ]);

                $item->product->decrement('stock', $item->quantity);
            }

            $cart->items()->delete();
        });

        return redirect()
            ->route('orders.index')
            ->with('success', 'Pesanan berhasil dibuat.');
    }

    public function index(): View
    {
        $orders = Order::with('items.product')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }
}