<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
  return view('welcome');
});

Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('register/store', [RegisterController::class, 'store'])->name('register.store');
// login
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login/auth', [LoginController::class, 'authenticate'])->name('login.auth');

Route::middleware(['auth'])->group(function () {
  // dashboard
  Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
  Route::get('dashboard/diagramProfit', [DashboardController::class, 'diagramProfit'])->name('dashboard.diagramProfit');

  // kasir
  Route::get('kasir', [KasirController::class, 'index'])->name('kasir');
  Route::get('kasir/{id}/dataBarang', [KasirController::class, 'dataBarang'])->name('kasir.dataBarang');
  Route::post('kasir/transaksi', [KasirController::class, 'transaksi'])->name('kasir.transaksi');
  Route::get('kasir/{id}/print', [KasirController::class, 'print'])->name('kasir.print');
  
  // barang
  Route::get('barang', [BarangController::class, 'index'])->name('barang');
  Route::get('barang/create', [BarangController::class, 'create'])->name('barang.create');
  Route::post('barang/store', [BarangController::class, 'store'])->name('barang.store');
  Route::get('barang/{id}/edit', [BarangController::class, 'edit'])->name('barang.edit');
  Route::put('barang/{id}/update', [BarangController::class, 'update'])->name('barang.update');
  Route::post('barang/delete', [BarangController::class, 'delete'])->name('barang.delete');
  
  // transaksi
  Route::get('transaksi', [TransaksiController::class, 'index'])->name('transaksi');
  Route::get('transaksi/{id}/show', [TransaksiController::class, 'show'])->name('transaksi.show');
  
  // logout
  Route::post('login/logout', [LoginController::class, 'logout'])->name('logout');
});