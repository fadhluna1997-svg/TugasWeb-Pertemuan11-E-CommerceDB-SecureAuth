
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Produk - Luna Store</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f6fa;
            margin: 0;
            padding: 30px;
            color: #222;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
        }

        h1 {
            margin-top: 0;
        }

        a, button {
            display: inline-block;
            padding: 9px 14px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }

        .add {
            background: #2563eb;
            color: white;
            margin-bottom: 18px;
        }

        .edit {
            background: #facc15;
            color: #222;
        }

        .delete {
            background: #dc2626;
            color: white;
            margin-left: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #f1f5f9;
        }

        .success {
            padding: 12px;
            background: #dcfce7;
            margin-bottom: 15px;
            border-radius: 6px;
        }

        .actions {
            white-space: nowrap;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Kelola Produk</h1>
        <p>Selamat datang di halaman pengelolaan produk Luna Store.</p>

        @if (session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        <a class="add" href="{{ route('products.create') }}">
            + Tambah Produk
        </a>

        <a href="{{ route('products.index') }}">
            Lihat Katalog
        </a>

        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>{{ $products->firstItem() + $loop->index }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name ?? '-' }}</td>
                        <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td>{{ $product->stock }}</td>

                        <td class="actions">
                            <a class="edit"
                               href="{{ route('products.edit', $product) }}">
                                Edit
                            </a>

                            @if (auth()->check() && auth()->user()->role === 'admin')
                                <form
                                    action="{{ route('products.destroy', $product) }}"
                                    method="POST"
                                    style="display: inline;"
                                    onsubmit="return confirm('Yakin ingin menghapus produk ini?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button class="delete" type="submit">
                                        Hapus
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Belum ada produk.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top: 20px;">
            {{ $products->links() }}
        </div>
    </div>
</body>
</html>
