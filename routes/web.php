<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShoeController;

// Halaman Utama
Route::get('/', [ShoeController::class, 'home'])->name('home');
Route::get('/koleksi', [ShoeController::class, 'products'])->name('products');
Route::get('/brand', [ShoeController::class, 'brands'])->name('brands');
Route::get('/brand/{slug}/ulasan', [ShoeController::class, 'brandReviews'])->name('brand.reviews');
Route::get('/tentang', [ShoeController::class, 'about'])->name('about');
Route::get('/kontak', [ShoeController::class, 'contact'])->name('contact');

// Cart
Route::get('/keranjang', [ShoeController::class, 'cartIndex'])->name('cart.index');
Route::post('/keranjang/tambah', [ShoeController::class, 'cartAdd'])->name('cart.add');
Route::put('/keranjang/{key}', [ShoeController::class, 'cartUpdate'])->name('cart.update');
Route::delete('/keranjang/{key}', [ShoeController::class, 'cartRemove'])->name('cart.remove');
Route::delete('/keranjang', [ShoeController::class, 'cartClear'])->name('cart.clear');

// Checkout
Route::get('/checkout', [ShoeController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [ShoeController::class, 'checkoutProcess'])->name('checkout.process');
Route::get('/checkout/nota', [ShoeController::class, 'orderReceipt'])->name('checkout.receipt');