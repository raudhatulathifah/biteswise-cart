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
    <tr>
      <td><div class="py-4 align-items-center"><input class="form-check-input me-2" type="checkbox" value="" checked></div></td>
      <td>
        <div class = "d-flex align-items-center">
            <img src="https://via.placeholder.com/100" class="product-image me-3" alt="Product Image">
            <div>
                  <h6>{{ $item->nama_produk }}</h6>
                  <small>{{ $item->berat}} gr | {{ $item->kalori}} cal</small>
              </div>
        </div>
      </td>
      <td class="text-center"><div class= "py-4 align-items-center">Rp. {{ number_format($item->harga, 0) }}</div></td>
      <td>
        <div class="d-flex text-center py-4 justify-content-center">
            <button class="btn btn-outline-secondary"><i class="bi bi-dash"></i></button>
            <span class="mx-3">{{ $item->kuantitas}}</span>
            <button class="btn btn-outline-secondary"><i class="bi bi-plus"></i></button>
        </div>
      </td>
      <td class="text-center"><div class="py-4 align-items-center text-success fw-medium">Rp {{number_format($item->harga  * $item->kuantitas) }}</div></td>

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

<div class="card bg-white rounded-4">
    <div class="d-flex justify-content-end align-items-center py-2">
        <div class= px-2>
            <span>Total (2 Produk):</span>
        </div>
        <div>
            <span class="px-3 text-success fw-medium fs-4">Rp50.000</span>
        </div>
        <div>
            <button class="btn btn-success mx-3 px-4 rounded-5">Buat Pesanan</button>
        </div>

    </div>
</div>
</div>
</section>

@endsection
