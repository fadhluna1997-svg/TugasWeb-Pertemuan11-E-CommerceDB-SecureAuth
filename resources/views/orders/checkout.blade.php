<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Checkout
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if ($cart->items->isEmpty())
                <div class="bg-white shadow-sm sm:rounded-lg p-6 text-center">
                    <p class="text-gray-600">Keranjang masih kosong.</p>

                    <a href="{{ route('products.index') }}"
                       class="inline-block mt-4 px-4 py-2 bg-gray-800 text-white rounded">
                        Lihat Produk
                    </a>
                </div>
            @else

                <div class="bg-white shadow-sm sm:rounded-lg p-6">

                    <h3 class="text-lg font-semibold mb-4">
                        Ringkasan Pesanan
                    </h3>

                    <div class="space-y-3 mb-6">
                        @foreach ($cart->items as $item)
                            <div class="flex justify-between border-b pb-2">
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

                    <div class="flex justify-between text-lg font-bold mb-6">
                        <span>Total</span>

                        <span>
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </span>
                    </div>

                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf

                        <div class="mb-6">
                            <label class="block font-medium mb-1">
                                Alamat Pengiriman
                            </label>

                            <textarea name="shipping_address"
                                      rows="4"
                                      class="w-full border-gray-300 rounded"
                                      placeholder="Masukkan alamat lengkap..."
                                      required>{{ old('shipping_address') }}</textarea>

                            @error('shipping_address')
                                <p class="text-red-600 text-sm mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex gap-3">
                            <button type="submit"
                                    class="px-4 py-2 bg-gray-800 text-white rounded">
                                Buat Pesanan
                            </button>

                            <a href="{{ route('cart.index') }}"
                               class="px-4 py-2 bg-gray-200 rounded">
                                Kembali ke Keranjang
                            </a>
                        </div>
                    </form>

                </div>

            @endif

        </div>
    </div>
</x-app-layout>