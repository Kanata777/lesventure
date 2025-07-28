<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PorterController;
use App\Http\Controllers\KabarPetualangController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\KeranjangDetailController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CheckoutController;
use App\Models\Produk;

//
// =======================
// ROUTE UNTUK USER BIASA
// =======================
//

// Beranda / Dashboard Umum
Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');

// Produk (User)
Route::get('/produk', [ProdukController::class, 'list'])->name('produk');
Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.detail');
Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');

// Porter (User)
Route::get('/porter', [PorterController::class, 'list'])->name('porter');

// Kabar Petualang (User)
Route::get('/kabar', [KabarPetualangController::class, 'list'])->name('kabar_petualang.list');
Route::get('/kabar-petualang/{id}', [KabarPetualangController::class, 'show'])->name('kabarpetualang.detail');

// Keranjang
Route::middleware(['auth'])->group(function () {
    Route::get('/keranjang', [KeranjangDetailController::class, 'list'])->name('keranjang.list');
    Route::post('/keranjang-detail', [KeranjangDetailController::class, 'store'])->name('keranjang_detail.store');
    Route::delete('/keranjang/{id}', [KeranjangDetailController::class, 'destroy'])->name('keranjang.destroy');
    Route::delete('/keranjang/detail/{id}', [KeranjangDetailController::class, 'destroyDetail'])->name('keranjang.detail.destroy');
});

// Auth
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//
// ===================
// ROUTE UNTUK ADMIN
// ===================
//

// Dashboard Admin
Route::get('/admin', [AdminController::class, 'admin'])->name('admin.dashboard');

// Admin area dengan prefix dan penamaan "admin."
Route::prefix('admin')->name('admin.')->group(function () {
    // Produk
    Route::get('/produk', [ProdukController::class, 'adminIndex'])->name('produk');
    Route::get('/ubah/{id}', [ProdukController::class, 'ubah'])->name('admin.ubah');
    Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::get('/tambah', [ProdukController::class, 'tambah'])->name('admin.tambah');
    Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');



    // Porter
    Route::get('/porter', [PorterController::class, 'adminIndex'])->name('porter');
    Route::get('/ubahporter/{id}', [PorterController::class, 'ubah'])->name('admin.ubahporter');
    Route::put('/porter/{id}', [PorterController::class, 'update'])->name('porter.update');
    Route::get('/tambah-porter', [PorterController::class, 'tambah'])->name('tambahporter');
    Route::post('/porter', [PorterController::class, 'store'])->name('porter.store');

    // Kabar Petualang
    Route::get('/kabar', [KabarPetualangController::class, 'adminIndex'])->name('kabar');

    // Riwayat / Chat
    Route::get('/riwayat', [RiwayatController::class, 'adminIndex'])->name('chat');
});

//
// ===================
// PEMBAYARAN & CHAT
// ===================
//

Route::post('/checkout/token', [CheckoutController::class, 'token']);
Route::get('/checkout/success', [CheckoutController::class, 'success']);
Route::get('/checkout/pending', [CheckoutController::class, 'pending']);
Route::post('/checkout/clear-cart', [CheckoutController::class, 'clearCart']);
Route::post('/checkout/cek-status', [CheckoutController::class, 'cekStatus'])->name('checkout.cekStatus');
Route::get('/checkout/status', [CheckoutController::class, 'statusPage']);
Route::get('/riwayat', [CheckoutController::class, 'riwayat'])->name('checkout.riwayat');
Route::post('/checkout/simulate-callback', [CheckoutController::class, 'simulateCallback']);

// Chat
Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');



Route::view('/login', 'auth.login')->name('login');
Route::view('/password/request', 'auth.reset-password')->name('password.request');

Route::post('/password/reset', [LoginController::class, 'resetPassword'])->name('password.reset');

