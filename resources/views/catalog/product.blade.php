@extends('layouts.main') <!-- Extends the main layout -->
@section('title', 'Produk') <!-- Sets the title for the page -->

@section('content')

<div class="mt-5">
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nama Produk</th>
      <th scope="col">Harga</th>
      <th scope="col">Detail</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($products as $index => $item)
    <tr>
    <th scope="row">{{ $index + 1 }}</th> 
      <td>{{ $item->nama_produk }}</td>
      <td>{{ $item->harga }}</td>
      <td><a href="{{ route('produk.show', $item->id) }}" class="btn btn-light">
      <i class="bi bi-eye"></i>
      </a></td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
@endsection