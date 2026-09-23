<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailTransaksi extends Model
{
    use HasFactory;

    // Nama tabel eksplisit agar tidak salah ke tabel "detail_transaksis"
    // (Laravel selalu me-plural-kan nama model secara otomatis).
    protected $table = 'detail_transaksi';

    protected $fillable = [
        'transaksi_id',
        'produk_id',
        'jumlah',
        'subtotal',
    ];

    protected $casts = [
        'transaksi_id' => 'integer',
        'produk_id' => 'integer',
        'jumlah' => 'integer',
        'subtotal' => 'integer',
    ];

    /**
     * RELASI belongsTo (sisi pertama): setiap baris DETAIL dimiliki oleh SATU transaksi.
     * Kuncinya ada di kolom `transaksi_id` pada tabel ini.
     *
     * $detail->transaksi  => objek model Transaksi induknya
     */
    public function transaksi(): BelongsTo
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id');
    }

    /**
     * RELASI belongsTo (sisi kedua): setiap baris DETAIL merujuk ke SATU produk.
     * Kuncinya ada di kolom `produk_id` pada tabel ini.
     *
     * $detail->produk  => objek model Produk (nama, harga, dsb.)
     */
    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
