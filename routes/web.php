<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::resource('produk', ProductController::class);
// Route::resource('cart', CartController::class);
Route::post('/cart/tambahkeranjang',[CartController::class, 'tambahKeranjang'])->name('cart.tambahKeranjang');
Route::get('/cart',[CartController::class, 'index'])->name('cart.index');
Route::delete('/cart/destroy/{id}',[CartController::class, 'destroy'])->name('cart.destroy');




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
