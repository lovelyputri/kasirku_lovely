<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Seeder;

/**
 * Seeder data awal produk supaya aplikasi langsung bisa dicoba
 * tanpa perlu mengetik data satu per satu lewat form.
 */
class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        // Data contoh toko make up: nama, harga, stok
        $daftarProduk = [
            ['nama_produk' => 'Lipstik Matte Nude Rose',      'harga' => 45000, 'stok' => 40],
            ['nama_produk' => 'Lip Tint Cherry 5ml',          'harga' => 35000, 'stok' => 50],
            ['nama_produk' => 'Bedak Padat Compact 12g',      'harga' => 55000, 'stok' => 35],
            ['nama_produk' => 'Cushion Foundation 15g',       'harga' => 89000, 'stok' => 25],
            ['nama_produk' => 'Maskara Waterproof 8ml',       'harga' => 48000, 'stok' => 30],
            ['nama_produk' => 'Eyeliner Pensil Hitam',        'harga' => 25000, 'stok' => 60],
            ['nama_produk' => 'Eyeshadow Palette 9 Warna',    'harga' => 75000, 'stok' => 20],
            ['nama_produk' => 'Blush On Pink Peach',          'harga' => 42000, 'stok' => 0],
            ['nama_produk' => 'Concealer Cair 6ml',           'harga' => 39000, 'stok' => 28],
            ['nama_produk' => 'Setting Spray 60ml',           'harga' => 65000, 'stok' => 15],
            ['nama_produk' => 'Pensil Alis Cokelat',          'harga' => 22000, 'stok' => 0],   // contoh stok habis
        ];

        foreach ($daftarProduk as $produk) {
            Produk::firstOrCreate(['nama_produk' => $produk['nama_produk']], $produk);
        }
    }
}
