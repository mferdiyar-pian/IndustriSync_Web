@extends('layouts.app')

@section('content')
<div class="row mb-5">
    <div class="col-12">
        <h3 class="fw-bold mb-1">Seluruh Transaksi Sistem</h3>
        <p class="text-muted">Pantau semua pesanan yang masuk dari pelanggan IndustriSync secara real-time.</p>
    </div>
</div>

<div class="card border-0 shadow-sm" style="border-radius: 24px;">
    <div class="card-header bg-white py-4 px-4 border-0 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0">Log Transaksi</h5>
        <div class="d-flex gap-2">
            <button class="btn btn-light rounded-pill px-3 border fw-bold small">Semua</button>
            <button class="btn btn-light rounded-pill px-3 border fw-bold small">Lunas</button>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle border-0 mb-0">
                <thead class="bg-light text-muted small uppercase">
                    <tr>
                        <th class="ps-4 py-3 border-0">Invoice</th>
                        <th class="border-0">Pelanggan</th>
                        <th class="border-0">Total</th>
                        <th class="border-0">Profit UMKM</th>
                        <th class="border-0">Status</th>
                        <th class="pe-4 text-end border-0">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $tx)
                        <tr>
                            <td class="ps-4 py-4 border-0">
                                <div class="fw-bold text-primary">{{ $tx->invoice_number }}</div>
                                <div class="text-muted small">{{ $tx->created_at->format('d M Y, H:i') }}</div>
                            </td>
                            <td class="border-0">
                                <div class="fw-bold text-dark">{{ $tx->user->name }}</div>
                                <div class="text-muted small">{{ $tx->user->email }}</div>
                            </td>
                            <td class="border-0 fw-bold">Rp {{ number_format($tx->total_amount, 0, ',', '.') }}</td>
                            <td class="border-0 text-success fw-bold">Rp {{ number_format($tx->profit, 0, ',', '.') }}</td>
                            <td class="border-0">
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2 fw-bold">Paid</span>
                            </td>
                            <td class="pe-4 text-end border-0">
                                <a href="{{ route('transactions.show', $tx->id) }}" class="btn btn-sm btn-primary-user rounded-pill px-4 py-2 shadow-sm fw-bold">
                                    Lihat Struk
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-4 d-flex justify-content-center">
    {{ $transactions->links() }}
</div>
@endsection
