@extends('user.layouts.app')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h3 class="fw-bold">Keranjang Belanja</h3>
        <p class="text-muted">Kelola item pilihan Anda sebelum melakukan pembayaran.</p>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm p-4" style="border-radius: 20px;">
            @if(count($cart) > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="text-muted small uppercase">
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-end">Subtotal</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $id => $details)
                                <tr data-id="{{ $id }}">
                                    <td style="min-width: 200px;">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $details['image'] ? asset('storage/'.$details['image']) : 'https://ui-avatars.com/api/?name='.urlencode($details['name']).'&background=random' }}" 
                                                 class="rounded-3 me-3" width="60" height="60" style="object-fit: cover;">
                                            <div class="fw-bold text-dark">{{ $details['name'] }}</div>
                                        </div>
                                    </td>
                                    <td>Rp {{ number_format($details['price'], 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        <input type="number" value="{{ $details['quantity'] }}" class="form-control update-cart rounded-pill text-center mx-auto" style="width: 80px;" min="1">
                                    </td>
                                    <td class="text-end fw-bold">Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-light text-danger remove-from-cart rounded-circle p-2">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('user.products.index') }}" class="btn btn-light rounded-pill px-4">
                        <i class="fas fa-arrow-left me-2"></i> Lanjut Belanja
                    </a>
                    <form action="{{ route('user.cart.clear') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger rounded-pill px-4">Bersihkan Keranjang</button>
                    </form>
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-shopping-basket fa-5x text-light"></i>
                    </div>
                    <h5 class="fw-bold">Keranjang Anda Kosong</h5>
                    <p class="text-muted">Mulailah jelajahi produk kami dan temukan apa yang Anda butuhkan.</p>
                    <a href="{{ route('user.products.index') }}" class="btn btn-primary-user mt-3 rounded-pill px-4">Mulai Jelajah</a>
                </div>
            @endif
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm p-4 sticky-top" style="border-radius: 20px; top: 100px;">
            <h5 class="fw-bold mb-4">Total Pembayaran</h5>
            <div class="d-flex justify-content-between mb-3 text-muted">
                <span>Jumlah Produk</span>
                <span>{{ count($cart) }} Item</span>
            </div>
            <hr class="opacity-10">
            <div class="d-flex justify-content-between mb-4">
                <span class="h5 fw-bold text-dark">Total</span>
                <span class="h5 fw-bold text-primary">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
            <a href="{{ route('user.transactions.create') }}" class="btn btn-primary-user w-100 py-3 shadow rounded-pill fw-bold">
                Check Out Sekarang <i class="fas fa-chevron-right ms-2"></i>
            </a>
            
            <div class="mt-4 p-3 bg-light rounded-4 small text-muted">
                <div class="d-flex align-items-start mb-2">
                    <i class="fas fa-check-circle text-success mt-1 me-2"></i>
                    <span>Pembayaran aman dengan enkripsi SSL</span>
                </div>
                <div class="d-flex align-items-start">
                    <i class="fas fa-sync text-primary mt-1 me-2"></i>
                    <span>Dukungan pelanggan UMKM 24/7</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    document.querySelectorAll(".update-cart").forEach(input => {
        input.addEventListener("change", function (e) {
            let id = this.closest("tr").getAttribute("data-id");
            let quantity = e.target.value;

            fetch("{{ route('user.cart.update') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ id, quantity })
            }).then(() => window.location.reload());
        });
    });

    document.querySelectorAll(".remove-from-cart").forEach(button => {
        button.addEventListener("click", function (e) {
            Swal.fire({
                title: 'Hapus Item?',
                text: "Produk akan dihapus dari keranjang.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#2563eb',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                borderRadius: '15px'
            }).then((result) => {
                if (result.isConfirmed) {
                    let id = this.closest("tr").getAttribute("data-id");

                    fetch("{{ route('user.cart.remove') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({ id })
                    }).then(() => window.location.reload());
                }
            });
        });
    });
</script>
@endpush
