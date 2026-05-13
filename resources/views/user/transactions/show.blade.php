@extends('user.layouts.app')

@section('content')
<div class="row mb-5">
    <div class="col-12">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h3 class="fw-bold mb-1">Detail Transaksi</h3>
                <p class="text-muted">Invoice #{{ $transaction->invoice_number }}</p>
            </div>
            <a href="{{ route('user.transactions.index') }}" class="btn btn-light rounded-pill px-4 fw-bold">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm p-4 mb-4" style="border-radius: 24px;">
            <h5 class="fw-bold mb-4">Item Pesanan</h5>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="text-muted small uppercase">
                        <tr class="border-bottom">
                            <th class="py-3">Produk</th>
                            <th class="text-center">Harga</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaction->details as $detail)
                        <tr>
                            <td class="py-3">
                                <div class="fw-bold text-dark">{{ $detail->product->name }}</div>
                                <div class="text-muted small">{{ $detail->product->category->name }}</div>
                            </td>
                            <td class="text-center">Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                            <td class="text-center">{{ $detail->quantity }}</td>
                            <td class="text-end fw-bold">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="border-top">
                        <tr>
                            <td colspan="3" class="text-end pt-4 h5 fw-bold">Grand Total</td>
                            <td class="text-end pt-4 h5 fw-bold text-primary">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="card border-0 shadow-sm p-4" style="border-radius: 24px; background: linear-gradient(135deg, #f8fafc, #eff6ff);">
            <div class="d-flex align-items-center">
                <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-circle me-3">
                    <i class="fas fa-info-circle fs-4"></i>
                </div>
                <div>
                    <h6 class="fw-bold mb-1">Informasi Pengambilan</h6>
                    <p class="small text-muted mb-0">Silakan tunjukkan nomor invoice ini kepada petugas kasir untuk verifikasi barang.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm p-4 mb-4" style="border-radius: 24px;">
            <h5 class="fw-bold mb-4">Status Pesanan</h5>
            <div class="mb-4">
                <label class="small text-muted d-block mb-1">Status Pembayaran</label>
                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 fw-bold">
                    <i class="fas fa-check-circle me-1"></i> Success / Paid
                </span>
            </div>
            <div class="mb-4">
                <label class="small text-muted d-block mb-1">Waktu Transaksi</label>
                <div class="fw-bold text-dark">{{ $transaction->created_at->format('d F Y, H:i') }}</div>
            </div>
            <div class="mb-0">
                <label class="small text-muted d-block mb-1">Metode Integrasi</label>
                <div class="fw-bold text-dark">Sistem POS IndustriSync</div>
            </div>
        </div>

        <div class="card border-0 shadow-sm p-4 text-center bg-primary text-white" style="border-radius: 24px;">
            <i class="fas fa-receipt fa-4x mb-3 opacity-25"></i>
            <h6 class="fw-bold">Struk Digital</h6>
            <p class="small opacity-75 mb-0">Invoice ini sah sebagai bukti pembelian Anda di platform kami.</p>
        </div>
    </div>
</div>
@endsection
