@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6">
            <h4 class="fw-bold">Detail Transaksi</h4>
            <p class="text-muted">Invoice: {{ $transaction->invoice_number }}</p>
        </div>
        <div class="col-md-6 text-md-end">
            <a href="{{ route('transactions.invoice', $transaction->id) }}" class="btn btn-danger">
                <i class="fas fa-file-pdf me-2"></i> Download Invoice
            </a>
            <a href="{{ route('transactions.index') }}" class="btn btn-light ms-2">Kembali</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-borderless align-middle">
                            <thead class="border-bottom">
                                <tr>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transaction->details as $detail)
                                    <tr>
                                        <td>
                                            <div class="fw-bold">{{ $detail->product->name }}</div>
                                            <div class="text-muted small">{{ $detail->product->category->name }}</div>
                                        </td>
                                        <td>Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                                        <td>{{ $detail->quantity }}</td>
                                        <td class="text-end fw-bold">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="border-top">
                                <tr>
                                    <td colspan="3" class="text-end fw-bold pt-3">Grand Total</td>
                                    <td class="text-end fw-bold pt-3 text-primary h5">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h6 class="mb-0 fw-bold">Informasi Transaksi</h6>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label class="text-muted small d-block">Status Pembayaran</label>
                        @if($transaction->payment_status == 'paid')
                            <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">Lunas</span>
                        @elseif($transaction->payment_status == 'pending')
                            <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3">Pending</span>
                        @else
                            <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3">Gagal</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small d-block">Petugas Kasir</label>
                        <div class="fw-bold">{{ $transaction->user->name }}</div>
                    </div>
                    <div class="mb-3">
                        <label class="text-muted small d-block">Tanggal Transaksi</label>
                        <div class="fw-bold">{{ $transaction->created_at->format('d F Y, H:i') }}</div>
                    </div>
                    <div class="mb-0">
                        <label class="text-muted small d-block">Estimasi Keuntungan</label>
                        <div class="fw-bold text-success">Rp {{ number_format($transaction->profit, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
