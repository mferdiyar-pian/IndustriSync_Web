@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6">
            <h4 class="fw-bold">Transaksi Baru</h4>
        </div>
    </div>

    <form action="{{ route('transactions.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h6 class="mb-0 fw-bold">Pilih Produk</h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle" id="products-table">
                                <thead>
                                    <tr class="border-bottom">
                                        <th style="width: 50%">Produk</th>
                                        <th style="width: 20%">Harga</th>
                                        <th style="width: 20%">Jumlah</th>
                                        <th style="width: 10%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select name="products[0][id]" class="form-select product-select" required>
                                                <option value="">Pilih Produk</option>
                                                @foreach($products as $p)
                                                    <option value="{{ $p->id }}" data-price="{{ $p->price }}" data-stock="{{ $p->stock }}">
                                                        {{ $p->name }} (Stok: {{ $p->stock }})
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control-plaintext fw-bold product-price" value="Rp 0" readonly>
                                        </td>
                                        <td>
                                            <input type="number" name="products[0][quantity]" class="form-control product-qty" value="1" min="1" required>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-light text-danger remove-row"><i class="fas fa-times"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary mt-3" id="add-row">
                            <i class="fas fa-plus me-1"></i> Tambah Produk
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h6 class="mb-0 fw-bold">Ringkasan Pembayaran</h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Subtotal</span>
                            <span class="fw-bold" id="subtotal">Rp 0</span>
                        </div>
                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="fw-bold">Total</h5>
                            <h5 class="fw-bold text-primary" id="total">Rp 0</h5>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold">Status Pembayaran</label>
                            <select name="payment_status" class="form-select" required>
                                <option value="paid">Lunas</option>
                                <option value="pending">Pending</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-3 fw-bold">
                            Konfirmasi Transaksi
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    let rowIndex = 1;
    const products = @json($products);

    function calculateTotal() {
        let total = 0;
        document.querySelectorAll('tbody tr').forEach(row => {
            const select = row.querySelector('.product-select');
            const qtyInput = row.querySelector('.product-qty');
            if (select.value) {
                const price = parseFloat(select.options[select.selectedIndex].dataset.price);
                const qty = parseInt(qtyInput.value) || 0;
                total += price * qty;
            }
        });
        const formatted = 'Rp ' + total.toLocaleString('id-ID');
        document.getElementById('subtotal').innerText = formatted;
        document.getElementById('total').innerText = formatted;
    }

    document.getElementById('add-row').addEventListener('click', function() {
        const tbody = document.querySelector('tbody');
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>
                <select name="products[${rowIndex}][id]" class="form-select product-select" required>
                    <option value="">Pilih Produk</option>
                    ${products.map(p => `<option value="${p.id}" data-price="${p.price}" data-stock="${p.stock}">${p.name} (Stok: ${p.stock})</option>`).join('')}
                </select>
            </td>
            <td>
                <input type="text" class="form-control-plaintext fw-bold product-price" value="Rp 0" readonly>
            </td>
            <td>
                <input type="number" name="products[${rowIndex}][quantity]" class="form-control product-qty" value="1" min="1" required>
            </td>
            <td>
                <button type="button" class="btn btn-sm btn-light text-danger remove-row"><i class="fas fa-times"></i></button>
            </td>
        `;
        tbody.appendChild(newRow);
        rowIndex++;
    });

    document.addEventListener('change', function(e) {
        if (e.target.classList.contains('product-select')) {
            const row = e.target.closest('tr');
            const price = e.target.options[e.target.selectedIndex].dataset.price;
            row.querySelector('.product-price').value = price ? 'Rp ' + parseFloat(price).toLocaleString('id-ID') : 'Rp 0';
            calculateTotal();
        }
        if (e.target.classList.contains('product-qty')) {
            calculateTotal();
        }
    });

    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-row')) {
            const row = e.target.closest('tr');
            if (document.querySelectorAll('tbody tr').length > 1) {
                row.remove();
                calculateTotal();
            }
        }
    });
</script>
@endpush
