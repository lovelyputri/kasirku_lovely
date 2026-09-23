# SPESIFIKASI PROGRAM APLIKASI "KasirKu"

**Dokumen:** `spesifikasi_kasirku.pdf` (draf Markdown — konversi ke PDF dengan pandoc/menyetel print di browser)
**Nama Proyek / Folder:** `kasirku`
**Nama Database:** `db_kasirku`
**Arsitektur:** Laravel (MVC) — PHP 8.2, standar penulisan kode PSR-12
**Kelas / Peserta:** XII RPL — Uji Kompetensi Pemrogram Muda

---

## 1. Deskripsi Aplikasi

**KasirKu** adalah aplikasi web kasir (point of sale sederhana) untuk toko/retail kecil.
Aplikasi ini mengelola **master data produk**, mencatat **transaksi penjualan**
(pilih produk → masukkan jumlah → hitung total → simpan), **mengurangi stok produk secara otomatis**
setiap kali transaksi tersimpan, serta menyediakan **riwayat transaksi** beserta
**rangkuman total penjualan**.

Aplikasi dibangun dengan pola **MVC (Model – View – Controller)** pada framework Laravel:

| Bagian MVC | Tugas | File pada proyek |
|---|---|---|
| **Model** | Struktur tabel + relasi database (Eloquent ORM) | `app/Models/Produk.php`, `Transaksi.php`, `DetailTransaksi.php` |
| **View** | Tampilan antarmuka (Blade Template + Bootstrap 5) | `resources/views/**` |
| **Controller** | Logika bisnis: subtotal, total, validasi stok, penyimpanan | `app/Http/Controllers/ProdukController.php`, `TransaksiController.php` |
| **Routing** | Memetakan URL ke method controller | `routes/web.php` |
| **Migration** | Membuat struktur tabel di database | `database/migrations/*_create_*_table.php` |

---

## 2. Daftar Fitur Utama

1. **Menampilkan daftar produk** — tabel berisi nama, harga, dan stok (dengan badge stok habis), lengkap dengan CRUD (tambah, ubah, hapus) dan validasi input.
2. **Form transaksi penjualan** — memilih produk, memasukkan jumlah beli (boleh lebih dari satu item dalam satu nota), **preview total otomatis di browser**, dan pembatasan jumlah maksimal sesuai stok.
3. **Perhitungan bisnis terstruktur** — fungsi terpisah:
   - `hitungSubtotal($harga, $jumlah)` → subtotal per item = harga × jumlah
   - `hitungTotalBayar($subtotal)` → akumulasi seluruh subtotal menjadi total bayar
   - `kurangiStok($produk_id, $jumlah)` → pengurangan stok **dengan validasi stok tidak boleh kurang/negatif**
4. **Penyimpanan transaksi aman (database transaction)** — header transaksi, detail item, dan pengurangan stok disimpan dalam satu paket; bila terjadi kegagalan (mis. stok kurang) **semua data otomatis di-rollback** (tidak ada data setengah jadi).
5. **Riwayat transaksi + rangkuman** — tabel riwayat (tanggal, jumlah item, total bayar), detail struk per transaksi, serta ringkasan *Total Penjualan*, *Jumlah Transaksi*, dan *Total Unit Terjual*.
6. **Error handling & validasi input** — validasi server-side (`$request->validate()`), pesan error ramah untuk stok tidak mencukupi, dan penanganan produk yang sudah terhapus/terikat riwayat.

---

## 3. Struktur Database (Tabel & Relasi)

Database: **`db_kasirku`** (MySQL/MariaDB)

### 3.1 Tabel `produk` (master data / tabel induk)

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | bigint (primary key, auto increment) | Kode produk |
| `nama_produk` | string (varchar 255) | Nama barang, unik |
| `harga` | bigInteger | Harga satuan (rupiah) |
| `stok` | integer | Jumlah persediaan (wajib ≥ 0) |
| `created_at`, `updated_at` | timestamp | Kolom otomatis dari `timestamps()` |

### 3.2 Tabel `transaksi` (kepala transaksi / header)

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | bigint (primary key) | Kode nota |
| `tanggal` | dateTime | Waktu transaksi |
| `total_bayar` | bigInteger | Total akumulasi seluruh subtotal |
| `created_at`, `updated_at` | timestamp | Kolom otomatis |

### 3.3 Tabel `detail_transaksi` (rincian item / tabel penghubung)

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | bigint (primary key) | Kode baris detail |
| `transaksi_id` | foreignKey → `transaksi.id` | Pemilik nota (ON DELETE CASCADE) |
| `produk_id` | foreignKey → `produk.id` | Produk yang dibeli (ON DELETE RESTRICT) |
| `jumlah` | integer | Qty beli (wajib ≥ 1) |
| `subtotal` | bigInteger | Hasil `harga × jumlah` |
| `created_at`, `updated_at` | timestamp | Kolom otomatis |

### 3.4 Relasi Eloquent

```
transaksi (1) ──────< (n) detail_transaksi >────── (1) produk
   hasMany                 belongsTo / belongsTo
```

| Relasi | Tipe | Metode (file) | Kolom kunci |
|---|---|---|---|
| Transaksi → Detail | `hasMany` | `Transaksi::detailTransaksis()` | `detail_transaksi.transaksi_id` |
| Produk → Detail | `hasMany` | `Produk::detailTransaksis()` | `detail_transaksi.produk_id` |
| Detail → Transaksi | `belongsTo` | `DetailTransaksi::transaksi()` | `detail_transaksi.transaksi_id` |
| Detail → Produk | `belongsTo` | `DetailTransaksi::produk()` | `detail_transaksi.produk_id` |

---

## 4. Daftar Route (`routes/web.php`)

| No | Method | URL | Controller@Method | Fungsi |
|---|---|---|---|---|
| 1 | GET | `/` | `ProdukController@index` | Beranda = daftar produk |
| 2 | GET | `/produk` | `ProdukController@index` | Daftar produk (nama, harga, stok) |
| 3 | GET | `/produk/create` | `ProdukController@create` | Form tambah produk |
| 4 | POST | `/produk` | `ProdukController@store` | Simpan produk baru |
| 5 | GET | `/produk/{produk}/edit` | `ProdukController@edit` | Form ubah produk |
| 6 | PUT | `/produk/{produk}` | `ProdukController@update` | Simpan perubahan produk |
| 7 | DELETE | `/produk/{produk}` | `ProdukController@destroy` | Hapus produk |
| 8 | GET | `/transaksi/create` | `TransaksiController@create` | Form transaksi penjualan |
| 9 | POST | `/transaksi` | `TransaksiController@store` | Simpan transaksi + kurangi stok |
| 10 | GET | `/transaksi` | `TransaksiController@index` | Riwayat transaksi + rangkuman |
| 11 | GET | `/transaksi/{transaksi}` | `TransaksiController@show` | Detail struk transaksi |

---

## 5. Flowchart Alur Transaksi (Deskripsi Langkah / Diagram Teks)

### 5.1 Alur menyimpan transaksi penjualan

```
                 [MULAI: Buka form /transaksi/create]
                              |
                              v
                [User memilih produk & jumlah beli]
                              |
                              v
                  [Klik "Simpan Transaksi"]  ----(POST /transaksi)---->
                              |
                              v
                 [VALIDASI INPUT oleh Laravel]
                    /                      \
        valid (produk ada,               tidak valid
        jumlah >= 1)                        |
                    |                       v
                    v              [Kembali ke form + pesan error]
        [Buka DB TRANSACTION]                    |
                    |                            |
                    v                            |
        [Buat header transaksi            selesai (gagal)]
         tanggal + total_bayar = 0]              |
                    |                            |
                    v                            |
          [LOOP tiap item keranjang]             |
                    |                            |
                    v                            |
    [hitungSubtotal(harga, jumlah)]              |
         subtotal = harga x jumlah               |
                    |                            |
                    v                            |
    [Simpan baris detail_transaksi]              |
     (transaksi_id, produk_id, jumlah, subtotal) |
                    |                            |
                    v                            |
       [kurangiStok(produk_id, jumlah)]          |
              /            \                    |
     stok >= jumlah     stok < jumlah           |
            |                  |                |
            v                  v                |
 [stok = stok - jumlah]  [LEMPAR EXCEPTION]      |
  (stok hasil >= 0)             |                |
            |                   |                |
            v                   |                |
 [hitungTotalBayar(subtotal)]   |                |
  total = total + subtotal      |                |
            |                   |                |
            v                   |                |
   [Ada item lagi?] --ya--------+--> (ulang loop)|
       tidak |                                  |
            v                                   |
 [Update total_bayar pada header]               |
            |                                   |
            v                                   |
        [COMMIT]  <-----------------------------+
            |
            v
  [Redirect ke /transaksi + pesan sukses]
            |
            v
     [RIWAYAT TRANSAKSI tampil + rangkuman total penjualan]
            |
            v
         [SELESAI]
```

### 5.2 Alur saat terjadi kegagalan (error handling)

```
[Exception: stok tidak mencukupi / data tidak valid]
        |
        v
[DB ROLLBACK otomatis: header, detail, dan stok kembali seperti semula]
        |
        v
[Redirect ke form transaksi + pesan error, contoh:
 "Stok 'Beras 5kg' tidak mencukupi. Sisa stok: 3."]
        |
        v
[User memperbaiki input dan mengulang]
```

### 5.3 Alur perhitungan pada riwayat

```
[Tabel riwayat dimuat]
        |
        +--> SUM(total_bayar)  --> "Total Penjualan"
        +--> COUNT(transaksi)  --> "Jumlah Transaksi"
        +--> SUM(jumlah detail) --> "Total Unit Terjual"
```

---

## 6. Cara Menjalankan Aplikasi

```bash
# 1. Siapkan database (MySQL XAMPP sudah berjalan)
mysql -u root -e "CREATE DATABASE IF NOT EXISTS db_kasirku CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# 2. Sesuaikan .env (DB_DATABASE=db_kasirku, DB_USERNAME=root, DB_PASSWORD=)

# 3. Jalankan migrasi + data awal produk
php artisan migrate --seed

# 4. Jalankan server pengembangan
php artisan serve     # buka http://127.0.0.1:8000
```

---

## 7. Standar Kode

* Mengikuti standar **PSR-12** (namespace, brace di baris baru, 4 spasi indentasi, akhir file dengan baris baru) — dapat diverifikasi dengan `./vendor/bin/pint --test`.
* Komentar edukatif dipasang **hanya** pada bagian penting: fungsi perhitungan bisnis, validasi stok, relasi Eloquent, dan alur penyimpanan transaksi.
