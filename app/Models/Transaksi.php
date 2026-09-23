<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaksi extends Model
{
    use HasFactory;

    // Tetapkan nama tabel eksplisit: model "Transaksi" akan otomatis dicari
    // di tabel "transaksis" oleh Laravel, padahal tabel kita bernama "transaksi".
    protected $table = 'transaksi';

    protected $fillable = [
        'tanggal',
        'total_bayar',
    ];

    /**
     * Cast `tanggal` menjadi datetime Carbon (memudahkan formatting: ->format('d/m/Y H:i'))
     * dan `total_bayar` menjadi integer untuk perhitungan rangkuman penjualan.
     */
    protected $casts = [
        'tanggal' => 'datetime',
        'total_bayar' => 'integer',
    ];

    /**
     * RELASI hasMany: satu TRANSAKSI mempunyai BANYAK baris detail_transaksi.
     * Inilah pola "header - detail" (1 nota : n item).
     *
     * child (detail_transaksi) menyimpan kolom FK: transaksi_id
     */
    public function detailTransaksis(): HasMany
    {
        return $this->hasMany(DetailTransaksi::class, 'transaksi_id');
    }

    /**
     * Relasi "banyak ke banyak" tidak dipakai di sini, tetapi lewat relasi di atas
     * kita tetap bisa menjangkau produk tiap item:
     *   $transaksi->detailTransaksis()->with('produk')
     * (with('produk') = eager loading untuk menghindari N+1 query)
     */
}
