# LAPORAN DEBUGGING KASIRKU

+----+--------------------------------+----------------------------------+----------------------------------+--------+
| No | Bug                            | Penyebab                         | Solusi                           | Status |
+----+--------------------------------+----------------------------------+----------------------------------+--------+
| 1  | Route Tidak Ditemukan          | Terdapat route destroy yang      | Menghapus route destroy yang     | Fixed  |
|    |                                | double atau duplikat sehingga   | double atau duplikat.            |        |
|    |                                | route tidak dapat ditemukan.    |                                  |        |
+----+--------------------------------+----------------------------------+----------------------------------+--------+
| 2  | Perhitungan Subtotal           | Kesalahan pada logika           | Mengganti operator pembagian (/) | Fixed  |
|    |                                | perhitungan subtotal. Harga     | menjadi operator perkalian (*)   |        |
|    |                                | seharusnya dikalikan dengan     | pada perhitungan subtotal.      |        |
|    |                                | jumlah, bukan dibagi.           |                                  |        |
+----+--------------------------------+----------------------------------+----------------------------------+--------+
| 3  | Warna Active pada Menu Navbar  | Salah satu menu navbar belum   | Menambahkan kondisi atau class   | Fixed  |
|    |                                | memiliki kondisi atau class     | active agar warna active muncul  |        |
|    |                                | active.                         | ketika menu dipilih.             |        |
+----+--------------------------------+----------------------------------+----------------------------------+--------+
| 4  | Pagination Produk Index        | Pagination masih menggunakan   | Memperbaiki dan menyesuaikan     | Fixed  |
|    |                                | tampilan bawaan Laravel dan    | tampilan pagination agar lebih   |        |
|    |                                | belum sesuai desain aplikasi.  | rapi dan sesuai desain.          |        |
+----+--------------------------------+----------------------------------+----------------------------------+--------+

# LAPORAN DEBUGGING KASIRKU

## 1. Bug Route Tidak Ditemukan

**Penyebab:**
Terdapat route destroy yang double atau duplikat sehingga route tidak dapat ditemukan dan tidak bisa diakses dengan benar.

**Solusi:**
Menghapus route destroy yang double atau duplikat.

**Status:**
Fixed

## 2. Bug Perhitungan Subtotal

**Penyebab:**
Terdapat kesalahan pada logika perhitungan subtotal. Seharusnya harga dikalikan dengan jumlah, tetapi menggunakan pembagian sehingga hasil perhitungan tidak sesuai.

**Solusi:**
Mengganti operator pembagian (/) menjadi operator perkalian (*) pada perhitungan subtotal.

**Status:**
Fixed

## 3. Bug Warna Active pada Menu Navbar

**Penyebab:**
Salah satu menu pada navbar belum memiliki kondisi atau class active sehingga warna active tidak muncul ketika menu tersebut sedang dibuka.

**Solusi:**
Menambahkan kondisi atau class active pada menu tersebut agar warna active dapat muncul ketika menu sedang dipilih.

**Status:**
Fixed

## 4. Bug Pagination pada Halaman Produk Index

**Penyebab:**
Tampilan pagination pada halaman Produk Index belum sesuai dengan tampilan yang diharapkan karena masih menggunakan tampilan bawaan Laravel.

**Solusi:**
Memperbaiki dan menyesuaikan tampilan pagination pada halaman Produk Index agar lebih rapi dan sesuai dengan desain aplikasi.

**Status:**
Fixed
