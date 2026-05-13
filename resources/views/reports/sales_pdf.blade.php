<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 11px; color: #334155; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #4f46e5; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; }
        th { background: #f1f5f9; padding: 10px; border: 1px solid #e2e8f0; text-align: left; }
        td { padding: 10px; border: 1px solid #e2e8f0; }
        .summary { margin-top: 20px; width: 300px; float: right; }
        .summary p { margin: 5px 0; font-size: 14px; }
    </style>
</head>
<body>
    <div class="header">
        <h2 style="margin: 0; color: #4f46e5;">Laporan Penjualan IndustriSync</h2>
        <p style="margin: 5px 0;">Periode: {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nomor Invoice</th>
                <th>Petugas Kasir</th>
                <th style="text-align: right;">Total Transaksi</th>
                <th style="text-align: right;">Keuntungan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $tx)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $tx->created_at->format('d/m/Y H:i') }}</td>
                    <td><strong>{{ $tx->invoice_number }}</strong></td>
                    <td>{{ $tx->user->name }}</td>
                    <td style="text-align: right;">Rp {{ number_format($tx->total_amount, 0, ',', '.') }}</td>
                    <td style="text-align: right;">Rp {{ number_format($tx->profit, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary">
        <p><strong>Total Omzet:</strong> <span style="float: right;">Rp {{ number_format($data->sum('total_amount'), 0, ',', '.') }}</span></p>
        <p style="color: #22c55e;"><strong>Total Keuntungan:</strong> <span style="float: right;">Rp {{ number_format($data->sum('profit'), 0, ',', '.') }}</span></p>
    </div>
</body>
</html>
