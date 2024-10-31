<!-- Custom Styles -->
<!-- <style>
 .cart{
    background: #EEEFF3;
 }     -->
<!-- </style> -->
@extends('layouts.main') <!-- Extends the main layout -->
@section('title', 'Shopping Cart') <!-- Sets the title for the page -->

@section('content')
<section>
    <!-- Shopping Cart Container -->
    <div class="container mt-5">
        <div class="d-flex justify-content-between">
            <div class="d-flex align-items-center mb-3">
                <a href="{{ url()->previous() }}" class="btn btn-light me-3"><i class="bi bi-arrow-left"></i></a>
                <h4 class="fw-bold">Shopping Cart</h4>
            </div>
    
            <!-- Search Bar -->
            <div class="mb-3">
                <div class="input-group">
                    <input type="text" style="width:350px" class="form-control" placeholder="Cari Pesanan">
                    <button class="btn btn-outline-secondary" type="button">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
        </div>

    <!-- ///////////////////////////Table cart start///////////////////////-->
    <div class="card bg-white mb-3 p-3 rounded-4">

        <table class="table">
  <thead>
    <tr>
    <th class="text-center" scope="col" style="width: 5%;"></th> <!-- Checkbox column -->
    <th scope="col" style="width: 35%;">Produk</th> <!-- Product image -->
    <th class="text-center" scope="col" style="width: 15%;">Harga Satuan</th> <!-- Unit price -->
    <th class="text-center" scope="col" style="width: 20%;">Kuantitas</th> <!-- Quantity controls -->
    <th class="text-center" scope="col" style="width: 20%;">Total Harga</th> <!-- Total price -->
    <th class="text-center" scope="col" style="width: 5%;"></th> <!-- Icon delete -->
    </tr>
  </thead>
  <tbody>
        @foreach($cart as $item)
        <tr data-id="{{ $item->id }}" class="cart-item">
            <td>
                <div class="py-4 align-items-center">
                    <input class="form-check-input me-2 item-checkbox" type="checkbox" checked>
                </div>
            </td>
            <td>
                <div class="d-flex align-items-center">
                    <img src="https://via.placeholder.com/100" class="product-image me-3" alt="Product Image">
                    <div>
                        <h6>{{ $item->nama_produk }}</h6>
                        <small>{{ $item->berat }} gr | {{ $item->kalori }} cal</small>
                    </div>
                </div>
            </td>
            <td class="text-center">
                <div class="py-4 align-items-center">Rp. <span class="harga">{{ number_format($item->harga, 0) }}</span></div>
            </td>
            <td>
                <div class="d-flex text-center py-4 justify-content-center">
                    <button class="btn btn-outline-secondary btn-decrease"><i class="bi bi-dash"></i></button>
                    <span class="mx-3 kuantitas">{{ $item->kuantitas }}</span>
                    <button class="btn btn-outline-secondary btn-increase"><i class="bi bi-plus"></i></button>
                </div>
            </td>
            <td class="text-center">
                <div class="py-4 align-items-center text-success fw-medium"><span class="total-harga-item">{{ number_format($item->harga * $item->kuantitas, 0) }}</span></div>
            </td>
            <td>
            <div class="mt-3">
    <form action="{{ route('cart.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus item ini?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-link text-danger p-0" style="border: none; background: none; cursor: pointer;">
            <i class="bi bi-trash fs-4"></i>
        </button>
    </form>
</div>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
    </div>
<!-- /////////////////////////Table cart end//////////////////////// -->

<!-- Total Cart Summary -->
<div class="card bg-white rounded-4">
    <div class="d-flex justify-content-end align-items-center py-2">
        <div class="px-2">
            <span>Total (<span id="total-produk">{{ $cart->count() }}</span> Produk):</span>
        </div>
        <div>
            <span class="px-3 text-success fw-medium fs-4"><span id="total-harga">{{ number_format($cart->sum(fn($item) => $item->harga * $item->kuantitas), 0) }}</span></span>
        </div>
        <div>
            <button class="btn btn-success mx-3 px-4 rounded-5">Buat Pesanan</button>
        </div>
    </div>
</div>

</div>
</section>

@endsection

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const formatCurrency = (number) => new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(number);

        function updateTotalHarga() {
            let totalHarga = 0;
            let totalProduk = 0;
            const items = document.querySelectorAll('.cart-item');

            items.forEach(item => {
                const checkbox = item.querySelector('.item-checkbox');
                if (checkbox.checked) { // Hanya hitung item yang dicentang
                    const harga = parseInt(item.querySelector('.harga').innerText.replace(/[^0-9]/g, ''));
                    const kuantitas = parseInt(item.querySelector('.kuantitas').innerText);
                    const totalHargaItem = harga * kuantitas;
                    item.querySelector('.total-harga-item').innerText = formatCurrency(totalHargaItem);
                    totalHarga += totalHargaItem;
                    totalProduk++;
                }
            });

            document.getElementById('total-harga').innerText = formatCurrency(totalHarga);
            document.getElementById('total-produk').innerText = totalProduk;
        }

        document.querySelectorAll('.btn-increase').forEach(button => {
            button.addEventListener('click', function () {
                const itemRow = this.closest('.cart-item');
                let kuantitas = parseInt(itemRow.querySelector('.kuantitas').innerText);
                itemRow.querySelector('.kuantitas').innerText = ++kuantitas;
                updateTotalHarga();
            });
        });

        document.querySelectorAll('.btn-decrease').forEach(button => {
            button.addEventListener('click', function () {
                const itemRow = this.closest('.cart-item');
                let kuantitas = parseInt(itemRow.querySelector('.kuantitas').innerText);
                if (kuantitas > 1) {
                    itemRow.querySelector('.kuantitas').innerText = --kuantitas;
                    updateTotalHarga();
                }
            });
        });

        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function () {
                const itemRow = this.closest('.cart-item');
                const form = itemRow.querySelector('form');

                if (confirm('Apakah Anda yakin ingin menghapus item ini?')) {
                    fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            _method: 'DELETE' // Kirimkan method DELETE
                        })
                    })
                    .then(response => {
                        if (response.ok) {
                            itemRow.remove(); // Hapus dari tampilan
                            updateTotalHarga(); // Update total harga
                        } else {
                            alert('Gagal menghapus item.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                }
            });
        });

        document.querySelectorAll('.item-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                updateTotalHarga(); // Perbarui total saat checkbox diubah
            });
        });

        updateTotalHarga();
    });
</script>
