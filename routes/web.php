<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShoeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

Route::middleware('guest')->group(function () {
    Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

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

// Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login',  [AdminController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/produk', [AdminController::class, 'produk'])->name('produk');
        Route::get('/pesanan', [AdminController::class, 'pesanan'])->name('pesanan');
        Route::post('/pesanan/{id}/status', [AdminController::class, 'updateOrderStatus'])->name('pesanan.status');
        Route::delete('/pesanan/{id}', [AdminController::class, 'deleteOrder'])->name('pesanan.delete');
        Route::get('/pelanggan', [AdminController::class, 'pelanggan'])->name('pelanggan');
        Route::get('/brand', [AdminController::class, 'brand'])->name('brand');
    });
});