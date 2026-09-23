<?php

use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Route Aplikasi KasirKu
|--------------------------------------------------------------------------
| Dikelompokkan per bagian fitur agar rapi dan mudah dipelajari:
|   1. Halaman utama      -> /
|   2. Master produk      -> /produk (CRUD)
|   3. Transaksi penjualan-> /transaksi/create & POST /transaksi
|   4. Riwayat transaksi  -> /transaksi & /transaksi/{id}
*/

// 1. Halaman beranda: langsung daftar produk (fitur utama pertama)
Route::get('/', [ProdukController::class, 'index'])->name('home');

// 2. MASTER PRODUK — resource route ringkas untuk CRUD penuh
//    index   GET    /produk          -> daftar produk
//    create  GET    /produk/create   -> form tambah
//    store   POST   /produk          -> simpan produk baru
//    edit    GET    /produk/{produk}/edit -> form ubah (route model binding)
//    update  PUT    /produk/{produk} -> simpan perubahan
//    destroy  DELETE /produk/{produk} -> hapus produk
Route::prefix('produk')->name('produk.')->group(function () {
    Route::get('/', [ProdukController::class, 'index'])->name('index');
    Route::get('/create', [ProdukController::class, 'create'])->name('create');
    Route::post('/', [ProdukController::class, 'store'])->name('store');
    Route::get('/{produk}/edit', [ProdukController::class, 'edit'])->name('edit');
    Route::put('/{produk}', [ProdukController::class, 'update'])->name('update');
    Route::delete('/{produk}', [ProdukController::class, 'destroy'])->name('destroy');
});

// 3 & 4. TRANSAKSI PENJUALAN + RIWAYAT
Route::prefix('transaksi')->name('transaksi.')->group(function () {
    // Form penjualan (GET) dan proses simpan transaksi (POST)
    Route::get('/create', [TransaksiController::class, 'create'])->name('create');
    Route::post('/', [TransaksiController::class, 'store'])->name('store');

    // Riwayat transaksi + rangkuman total penjualan
    Route::get('/', [TransaksiController::class, 'index'])->name('index');

    // Detail/rincian satu transaksi (struk)
    // Urutan ini penting: '/create' harus didefinisikan SEBELUM '/{transaksi}'
    // agar kata "create" tidak tertangkap sebagai id transaksi.
    Route::get('/{transaksi}', [TransaksiController::class, 'show'])->name('show');
});
