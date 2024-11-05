<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;




class CartController extends Controller
{

    public function index()
{
    $cart = DB::table('cart')
        ->join('products', 'cart.product_id', '=', 'products.id') // Melakukan join dengan tabel products
        ->select('cart.*', 'products.nama_produk', 'products.harga', 'products.berat', 'products.kalori') // Memilih kolom yang diinginkan
        ->get();

    return view('cart', compact('cart')); // Mengirim data ke view
}



    public function tambahKeranjang(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id', // Validasi ID produk
        'kuantitas' => 'required|integer|min:1', // Validasi kuantitas
    ]);

    $productId = $request->input('product_id');
    $kuantitas = $request->input('kuantitas');

    // Simpan data ke dalam tabel cart
    \DB::table('cart')->insert([
        'product_id' => $productId,
        'kuantitas' => $kuantitas,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
}

public function destroy($id)
{
    // Mencari item cart berdasarkan ID
    $cartItem = Cart::find($id);

    // Memeriksa apakah item ada
    if ($cartItem) {
        $cartItem->delete(); // Menghapus item dari tabel cart

        return redirect()->route('cart.index')->with('success', 'Item berhasil dihapus dari keranjang.');
    }

    return redirect()->route('cart.index')->with('error', 'Item tidak ditemukan.');
}

public function checkout(Request $request)
{
    $itemIds = $request->input('itemIds'); // Ambil daftar ID item yang dicentang

    if ($itemIds) {
        // Hapus item dari database berdasarkan ID
        Cart::whereIn('id', $itemIds)->delete();
    }

    return response()->json(['message' => 'Pesanan berhasil dibuat!']);
}


}
