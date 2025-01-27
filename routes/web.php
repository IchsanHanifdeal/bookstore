<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenerbitController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengarangController;
use App\Http\Controllers\TransaksiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login/auth', [AuthController::class, 'auth'])->name('authenticate');
Route::get('/register', [AuthController::class, 'register'])->name('register');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/dashboard/buku', [BukuController::class, 'index'])->name('buku');
    Route::post('/dashboard/buku/post', [BukuController::class, 'store'])->name('store.buku');
    Route::put('/dashboard/buku/{id}/update', [BukuController::class, 'update'])->name('update.buku');
    Route::delete('/dashboard/buku/{id}/hapus', [BukuController::class, 'destroy'])->name('destroy.buku');

    Route::get('/dashboard/customer', [CustomerController::class, 'index'])->name('customer');
    Route::post('/dashboard/customer/post', [CustomerController::class, 'store'])->name('store.customer');
    Route::put('/dashboard/customer/{id}/update', [CustomerController::class, 'update'])->name('update.customer');
    Route::delete('/dashboard/customer/{id}/hapus', [CustomerController::class, 'destroy'])->name('destroy.customer');

    Route::get('/dashboard/kategori', [KategoriController::class, 'index'])->name('kategori');
    Route::post('/dashboard/kategori/post', [KategoriController::class, 'store'])->name('store.kategori');
    Route::put('/dashboard/kategori/{id}/update', [KategoriController::class, 'update'])->name('update.kategori');
    Route::delete('/dashboard/kategori/{id}/hapus', [KategoriController::class, 'destroy'])->name('destroy.kategori');

    Route::get('/dashboard/penerbit', [PenerbitController::class, 'index'])->name('penerbit');
    Route::post('/dashboard/penerbit/post', [PenerbitController::class, 'store'])->name('store.penerbit');
    Route::put('/dashboard/penerbit/{id}/update', [PenerbitController::class, 'update'])->name('update.penerbit');
    Route::delete('/dashboard/penerbit/{id}/hapus', [PenerbitController::class, 'destroy'])->name('destroy.penerbit');

    Route::get('/dashboard/pengarang', [PengarangController::class, 'index'])->name('pengarang');
    Route::post('/dashboard/pengarang/post', [PengarangController::class, 'store'])->name('store.pengarang');
    Route::put('/dashboard/pengarang/{id}/update', [PengarangController::class, 'update'])->name('update.pengarang');
    Route::delete('/dashboard/pengarang/{id}/hapus', [PengarangController::class, 'destroy'])->name('destroy.pengarang');

    Route::get('/dashboard/transaksi', [TransaksiController::class, 'index'])->name('transaksi');
    Route::post('/dashboard/transaksi/post', [TransaksiController::class, 'store'])->name('store.transaksi');
    Route::put('/dashboard/transaksi/{id}/update', [TransaksiController::class, 'update'])->name('update.transaksi');
    Route::delete('/dashboard/transaksi/{id}/hapus', [TransaksiController::class, 'destroy'])->name('destroy.transaksi');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
