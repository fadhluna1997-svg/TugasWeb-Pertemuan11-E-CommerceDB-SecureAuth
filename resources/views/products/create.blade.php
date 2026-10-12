```html
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - Luna Store</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f6fa;
            margin: 0;
            padding: 30px;
            color: #222;
        }

        .container {
            max-width: 650px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input, textarea, select {
            width: 100%;
            box-sizing: border-box;
            padding: 11px;
            margin-top: 7px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
        }

        button, .back {
            display: inline-block;
            margin-top: 20px;
            padding: 11px 16px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            cursor: pointer;
            font-size: 15px;
        }

        button {
            background: #2563eb;
            color: white;
        }

        .back {
            background: #e5e7eb;
            color: #222;
        }

        .errors {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px;
            border-radius: 6px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tambah Produk</h1>
        <p>Masukkan informasi produk baru.</p>

        @if ($errors->any())
            <div class="errors">
                <strong>Periksa kembali data berikut:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.store') }}" method="POST">
            @csrf

            <label for="name">Nama Produk</label>
            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                required
            >

            <label for="category_id">Kategori</label>
            <select id="category_id" name="category_id" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach ($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        @selected(old('category_id') == $category->id)
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <label for="description">Deskripsi</label>
            <textarea
                id="description"
                name="description"
                rows="4"
            >{{ old('description') }}</textarea>

            <label for="price">Harga (Rp)</label>
            <input
                type="number"
                id="price"
                name="price"
                min="0"
                step="0.01"
                value="{{ old('price') }}"
                required
            >

            <label for="stock">Stok</label>
            <input
                type="number"
                id="stock"
                name="stock"
                min="0"
                value="{{ old('stock', 0) }}"
                required
            >

            <button type="submit">Simpan Produk</button>
            <a class="back" href="{{ route('products.manage') }}">Kembali</a>
        </form>
    </div>
</body>
</html>
```