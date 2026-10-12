<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Keranjang Belanja
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                    {{ session('error') }}
                </div>
            @endif

            @if ($cart->items->count())

                <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">

                    <table class="w-full">
                        <thead>
                            <tr class="border-b">
                                <th class="p-4 text-left">Produk</th>
                                <th class="p-4 text-left">Harga</th>
                                <th class="p-4 text-left">Jumlah</th>
                                <th class="p-4 text-left">Subtotal</th>
                                <th class="p-4 text-left">Aksi</th>
                            </tr>
                        </thead>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pesanan Saya
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="space-y-4">

                @forelse ($orders as $order)

                    <div class="bg-white shadow-sm sm:rounded-lg p-6">

                        <div class="flex justify-between mb-4">
                            <div>
                                <h3 class="font-bold">
                                    Pesanan #{{ $order->id }}
                                </h3>

                                <p class="text-sm text-gray-500">
                                    {{ $order->created_at->format('d/m/Y H:i') }}
                                </p>
                            </div>

                            <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>

                        <div class="space-y-2 mb-4">
                            @foreach ($order->items as $item)
                                <div class="flex justify-between">
                                    <span>
                                        {{ $item->product->name }}
                                        × {{ $item->quantity }}
                                    </span>

                                    <span>
                                        Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                                    </span>
                                </div>
                            @endforeach
                        </div>

                        <div class="border-t pt-3">
                            <p class="font-bold">
                                Total:
                                Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                            </p>

                            <p class="text-sm text-gray-600 mt-2">
                                Alamat: {{ $order->shipping_address }}
                            </p>
                        </div>

                    </div>

                @empty

                    <div class="bg-white shadow-sm sm:rounded-lg p-6 text-center">
                        <p class="text-gray-600">
                            Belum ada pesanan.
                        </p>
                    </div>

                @endforelse

            </div>

            <div class="mt-4">
                {{ $orders->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
                        <tbody>
                            @php
                                $total = 0;
                            @endphp

                            @foreach ($cart->items as $item)

                                @php
                                    $subtotal = $item->price * $item->quantity;
                                    $total += $subtotal;
                                @endphp

                                <tr class="border-b">
                                    <td class="p-4">
                                        {{ $item->product->name }}
                                    </td>

                                    <td class="p-4">
                                        Rp {{ number_format($item->price, 0, ',', '.') }}
                                    </td>

                                    <td class="p-4">
                                        <form action="{{ route('cart.update', $item) }}"
                                              method="POST"
                                              class="flex gap-2">
                                            @csrf
                                            @method('PUT')

                                            <input type="number"
                                                   name="quantity"
                                                   value="{{ $item->quantity }}"
                                                   min="1"
                                                   class="w-20 border-gray-300 rounded">

                                            <button type="submit"
                                                    class="px-3 py-1 bg-gray-800 text-white rounded">
                                                Update
                                            </button>
                                        </form>
                                    </td>

                                    <td class="p-4">
                                        Rp {{ number_format($subtotal, 0, ',', '.') }}
                                    </td>

                                    <td class="p-4">
                                        <form action="{{ route('cart.remove', $item) }}"
                                              method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="text-red-600"
                                                    onclick="return confirm('Hapus produk dari keranjang?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table>

                </div>

                <div class="mt-6 bg-white shadow-sm sm:rounded-lg p-6">
                    <div class="flex justify-between items-center">
                        <span class="text-lg font-semibold">
                            Total
                        </span>

                        <span class="text-xl font-bold">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </span>
                    </div>
                </div>

            @else

                <div class="bg-white shadow-sm sm:rounded-lg p-6 text-center">
                    <p class="text-gray-600">
                        Keranjang masih kosong.
                    </p>

                    <a href="{{ route('products.index') }}"
                       class="inline-block mt-4 px-4 py-2 bg-gray-800 text-white rounded">
                        Lihat Produk
                    </a>
                </div>
<div class="mt-4">
    <a href="{{ route('orders.create') }}"
       class="inline-block px-4 py-2 bg-gray-800 text-white rounded">
        Checkout
    </a>
</div>
            @endif

        </div>
    </div>
</x-app-layout>