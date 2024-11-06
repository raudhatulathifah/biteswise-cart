@extends('layouts.main') <!-- Extends the main layout -->
@section('title', 'Produk') <!-- Sets the title for the page -->

@section('content')

<div class="container my-5">
    <!-- Search Bar -->
    <div class="d-flex justify-content-center mb-4">
        <input type="text" class="form-control w-50 rounded-pill px-4" placeholder="Cari Menu">
        <button class="btn btn-outline-secondary rounded-circle ms-2">
            <i class="bi bi-search"></i>
        </button>
    </div>

    <!-- Healthy Food Section -->
    <section>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="fw-bold">Healthy Food</h2>
            <a href="#" class="text-decoration-none text-dark">See All</a>
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($products as $item)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                    <img src="https://via.placeholder.com/200" alt="Product Image" class="product-image" alt="{{ $item->nama_produk }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->nama_produk }}</h5>
                            <p class="card-text text-success fw-semibold">Rp{{ number_format($item->harga, 0, ',', '.') }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-warning"><i class="bi bi-star-fill"></i> 4.5</span>
                                <a href="{{ route('produk.show', $item->id) }}" class="btn btn-success btn-sm">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

</div>


@endsection




