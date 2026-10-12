<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Produk
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <h3 class="text-2xl font-bold mb-6">
                    {{ $product->name }}
                </h3>

                <div class="space-y-4">

                    <div>
                        <span class="font-semibold">Kategori:</span>
                        {{ $product->category->name }}
                    </div>

                    <div>
                        <span class="font-semibold">Deskripsi:</span>
                        <p class="mt-1">
                            {{ $product->description ?: '-' }}
                        </p>
                    </div>

                    <div>
                        <span class="font-semibold">Harga:</span>
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </div>

                    <div>
                        <span class="font-semibold">Stok:</span>
                        {{ $product->stock }}
                    </div>

                    <div>
                        <span class="font-semibold">Gambar:</span>
                        {{ $product->image ?: '-' }}
                    </div>

                </div>

                <div class="mt-6 flex gap-3">

    @if ($product->stock > 0)
        <form action="{{ route('cart.add', $product) }}" method="POST">
            @csrf

            <button type="submit"
                    class="px-4 py-2 bg-gray-800 text-white rounded">
                + Tambah ke Keranjang
            </button>
        </form>
    @else
        <span class="px-4 py-2 bg-red-100 text-red-700 rounded">
            Stok Habis
        </span>
    @endif

    <a href="{{ route('products.edit', $product) }}"
       class="px-4 py-2 bg-gray-200 text-gray-800 rounded">
        Edit
    </a>

    <a href="{{ route('products.index') }}"
       class="px-4 py-2 bg-gray-200 text-gray-800 rounded">
        Kembali
    </a>

</div>

            </div>
        </div>
    </div>
</x-app-layout>