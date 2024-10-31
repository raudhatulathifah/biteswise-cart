

@extends('layouts.main') <!-- Extends the main layout -->
@section('title', 'Produk') <!-- Sets the title for the page -->

@section('content')
<section>

<div class="container mt-4">

  <!-- Search Bar -->
  <div class="d-flex align-items-center justify-content-between mb-4">
    <div class="input-group w-75">
      <input type="text" class="form-control" placeholder="Cari Menu" aria-label="Cari Menu">
      <button class="btn btn-light" type="button">
        <i class="bi bi-search"></i>
      </button>
    </div>
    <a href="{{ url('/cart') }}" class="btn btn-light">
      <i class="bi bi-cart"></i>
    </a>
  </div>

  <!-- Back Button -->
  <div class="mb-4">
  <a href="{{ route('produk.index') }}" class="btn btn-light me-3"><i class="bi bi-arrow-left"></i></a>
  </div>

  <!-- Product Details -->
  <div class="row">
    <div class="col-md-4">
        <!-- Product Image -->
        <img src="https://via.placeholder.com/200" alt="Product Image" class="product-image">
    </div>
    <div class="col-md-8">
        <!-- Product Info -->
        <h2 class="fw-bold">{{ $product->nama_produk}}</h2>

        <div class="d-flex justify-content-between align-items-center">
        <p class="fs-5 text-dark mb-0 fw-bold">Rp. {{ number_format($product->harga, 0) }}</p>
            <div class="d-flex align-items-center fs-6">
                <i class="bi bi-star-fill text-warning me-2"></i>
                <span>4.5 | 135 Reviews</span>
            </div>
        </div>
        
        <p>{{ $product->berat}} gr | {{ $product->kalori}} cal</p>

        
            <form id="cartForm" action="{{ route('cart.tambahKeranjang') }}" method="POST">
    @csrf <!-- Menambahkan token CSRF -->
    <div class="d-flex justify-content-between mt-5 align-items-center">
    <div>
        <input type="hidden" name="product_id" value="{{ $product->id }}"> <!-- Input untuk ID produk -->
    <div class="quantity-controls d-flex align-items-center ms-auto">
        <button type="button" id="decrement" style="background:#D9D9D9;" class="btn btn-outline-secondary rounded-5 text-dark">
            <i class="bi bi-dash"></i>
        </button>
        <span id="quantity" class="mx-3">1</span>
        <button type="button" id="increment" style="background:#D9D9D9;" class="btn btn-outline-secondary rounded-5 text-dark">
            <i class="bi bi-plus"></i>
        </button>
        <input type="hidden" name="kuantitas" id="kuantitas" value="1">
        </div>
    </div>
    <div>
    <button type="submit" class="btn rounded-5" style="background:#D9D9D9;">Tambahkan ke Keranjang</button>
    </div>
    </div>
</form>
    </div>
</div>

</section>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const quantityElement = document.getElementById('quantity');
    const incrementButton = document.getElementById('increment');
    const decrementButton = document.getElementById('decrement');
    const quantityInput = document.getElementById('kuantitas'); // Input tersembunyi

    let quantity = parseInt(quantityElement.innerText);

    incrementButton.addEventListener('click', function () {
        quantity++;
        quantityElement.innerText = quantity;
        quantityInput.value = quantity; // Update nilai input tersembunyi
    });

    decrementButton.addEventListener('click', function () {
        if (quantity > 1) { // Prevents going below 1
            quantity--;
            quantityElement.innerText = quantity;
            quantityInput.value = quantity; // Update nilai input tersembunyi
        }
    });
});
</script>


@endsection