<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk | Luna Store</title>
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f6fa;
            color: #222;
        }
        header {
            background: #24243e;
            color: white;
            padding: 22px 6%;
        }
        header h1 { margin: 0 0 8px; }
        header p { margin: 0; color: #dedeee; }
        main { max-width: 1200px; margin: auto; padding: 28px 20px; }
        .intro { margin-bottom: 24px; }
        .products {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
            gap: 20px;
        }
        .card {
            background: white;
            border-radius: 12px;
            padding: 18px;
            box-shadow: 0 3px 12px #0000000d;
        }
        .category {
            color: #6464a5;
            font-size: 13px;
            margin-bottom: 10px;
        }
        .card h3 { margin: 8px 0; }
        .description { color: #666; font-size: 14px; min-height: 40px; }
        .price { font-size: 18px; font-weight: bold; margin: 14px 0 8px; }
        .stock { color: #555; font-size: 13px; }
        .pagination { margin-top: 28px; }
        .pagination a, .pagination span {
            display: inline-block;
            padding: 8px 12px;
            background: white;
            border-radius: 6px;
            margin: 3px;
            text-decoration: none;
            color: #24243e;
        }
        footer { text-align: center; padding: 24px; color: #666; }
    </style>
</head>
<body>
    <header>
        <h1>Luna Store</h1>
        <p>Temukan produk yang kamu butuhkan.</p>
    </header>

    <main>
        <div class="intro">
            <h2>Katalog Produk</h2>
            <p>Berikut daftar produk yang tersedia di toko kami.</p>
        </div>

        <div class="products">
            @forelse ($products as $product)
                <article class="card">
                    <div class="category">
                        {{ $product->category->name ?? 'Tanpa kategori' }}
                    </div>
                    <h3>{{ $product->name }}</h3>
                    <p class="description">
                        {{ $product->description ?? 'Tidak ada deskripsi.' }}
                    </p>
                    <div class="price">
                        Rp{{ number_format($product->price, 0, ',', '.') }}
                    </div>
                    <div class="stock">Stok: {{ $product->stock }}</div>
                </article>
            @empty
                <p>Belum ada produk yang tersedia.</p>
            @endforelse
        </div>

        <div class="pagination">
            {{ $products->links() }}
        </div>
    </main>

    <footer>&copy; {{ date('Y') }} Luna Store</footer>
</body>
</html>
