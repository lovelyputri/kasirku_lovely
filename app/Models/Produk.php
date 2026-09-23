<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produk extends Model
{
    use HasFactory;

    /**
     * Nama tabel ditetapkan eksplisit karena Laravel otomatis me-plural-kan
     * nama model ("produk" -> "produks"), sedangkan tabel kita bernama "produk".
     */
    protected $table = 'produk';

    /**
     * Daftar kolom yang boleh diisi massal (mass assignment protection).
     * Mencegah request iseng mengisi kolom sensitif seperti `id`.
     */
    protected $fillable = [
        'nama_produk',
        'harga',
        'stok',
    ];

    /**
     * Cast otomatis: nilai dari database di-cast menjadi integer,
     * sehingga `harga` dan `stok` selalu numerik saat dipakai perhitungan.
     */
    protected $casts = [
        'harga' => 'integer',
        'stok' => 'integer',
    ];

    /**
     * RELASI hasMany: satu PRODUK dapat muncul di BANYAK baris detail_transaksi.
     * Contoh pemakaian: $produk->detailTransaksis (koleksi rincian penjualan produk tsb).
     *
     * child (detail_transaksi) menyimpan kolom FK: produk_id
     */
    public function detailTransaksis(): HasMany
    {
        return $this->hasMany(DetailTransaksi::class, 'produk_id');
    }
}
