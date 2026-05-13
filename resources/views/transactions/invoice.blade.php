<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $transaction->invoice_number }}</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; color: #334155; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #4f46e5; padding-bottom: 20px; }
        .invoice-info { margin-bottom: 30px; }
        .invoice-info p { margin: 5px 0; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        th { background: #f1f5f9; text-align: left; padding: 12px; border-bottom: 1px solid #e2e8f0; }
        td { padding: 12px; border-bottom: 1px solid #e2e8f0; }
        .total { text-align: right; font-size: 20px; font-weight: bold; color: #4f46e5; }
        .footer { text-align: center; margin-top: 50px; font-size: 12px; color: #94a3b8; }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="color: #4f46e5; margin: 0;">IndustriSync Web</h1>
        <p style="margin: 5px 0;">Platform Integrasi & Monitoring UMKM</p>
    </div>

    <div class="invoice-info">
        <div style="float: left; width: 50%;">
            <p><strong>Nomor Invoice:</strong> #{{ $transaction->invoice_number }}</p>
            <p><strong>Tanggal Transaksi:</strong> {{ $transaction->created_at->format('d F Y, H:i') }}</p>
        </div>
        <div style="float: right; width: 50%; text-align: right;">
            <p><strong>Petugas Kasir:</strong> {{ $transaction->user->name }}</p>
            <p><strong>Status Pembayaran:</strong> <span style="color: {{ $transaction->payment_status == 'paid' ? '#22c55e' : '#f59e0b' }}">{{ strtoupper($transaction->payment_status) }}</span></p>
        </div>
        <div style="clear: both;"></div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th style="text-align: right;">Harga Satuan</th>
                <th style="text-align: center;">Jumlah</th>
                <th style="text-align: right;">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaction->details as $detail)
                <tr>
                    <td>
                        <strong>{{ $detail->product->name }}</strong><br>
                        <small style="color: #64748b;">{{ $detail->product->category->name }}</small>
                    </td>
                    <td style="text-align: right;">Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                    <td style="text-align: center;">{{ $detail->quantity }}</td>
                    <td style="text-align: right;">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        GRAND TOTAL: Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}
    </div>

    <div class="footer">
        <p>Terima kasih telah bertransaksi dengan kami.</p>
        <p>Invoice ini diterbitkan secara otomatis oleh sistem IndustriSync Web.</p>
    </div>
</body>
</html>
