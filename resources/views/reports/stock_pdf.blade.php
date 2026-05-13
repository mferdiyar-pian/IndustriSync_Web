<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Stok Produk</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 11px; color: #334155; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #4f46e5; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #f1f5f9; padding: 10px; border: 1px solid #e2e8f0; text-align: left; }
        td { padding: 10px; border: 1px solid #e2e8f0; }
    </style>
</head>
<body>
    <div class="header">
        <h2 style="margin: 0; color: #4f46e5;">Laporan Stok Produk IndustriSync</h2>
        <p style="margin: 5px 0;">Dicetak pada: {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th style="text-align: right;">Harga Jual</th>
                <th style="text-align: center;">Sisa Stok</th>
                <th>Status Stok</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $product)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td><strong>{{ $product->name }}</strong></td>
                    <td>{{ $product->category->name }}</td>
                    <td style="text-align: right;">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td style="text-align: center;">{{ $product->stock }}</td>
                    <td>
                        @if($product->stock <= 10)
                            <span style="color: #ef4444; font-weight: bold;">MENIPIS</span>
                        @else
                            <span style="color: #22c55e;">AMAN</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
