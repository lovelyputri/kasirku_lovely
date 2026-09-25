# LAPORAN DEBUGGING KASIRKU

+----+--------------------------------+----------------------------------+----------------------------------+--------+
| No | Bug                            | Penyebab                         | Solusi                           | Status |
+----+--------------------------------+----------------------------------+----------------------------------+--------+
| 1  | Route Tidak Ditemukan          | Terdapat route destroy yang      | Menghapus route destroy yang     | Fixed  |
|    |                                | double atau duplikat sehingga    | double atau duplikat.            |        |
|    |                                | route tidak dapat ditemukan.     |                                  |        |
+----+--------------------------------+----------------------------------+----------------------------------+--------+
| 2  | Perhitungan Subtotal           | Kesalahan pada logika            | Mengganti operator pembagian (/) | Fixed  |
|    |                                | perhitungan subtotal. Harga      | menjadi operator perkalian (*)   |        |
|    |                                | seharusnya dikalikan dengan      | pada perhitungan subtotal.       |        |
|    |                                | jumlah, bukan dibagi.            |                                  |        |
+----+--------------------------------+----------------------------------+----------------------------------+--------+
| 3  | Warna Active pada Menu Navbar  | Salah satu menu navbar belum     | Menambahkan kondisi atau class   | Fixed  |
|    |                                | memiliki kondisi atau class      | active agar warna active muncul  |        |
|    |                                | active.                          | ketika menu dipilih.             |        |
+----+--------------------------------+----------------------------------+----------------------------------+--------+
| 4  | Pagination Produk Index        | Pagination masih menggunakan     | Memperbaiki dan menyesuaikan     | Fixed  |
|    |                                | tampilan bawaan Laravel dan      | tampilan pagination agar lebih   |        |
|    |                                | belum sesuai desain aplikasi.    | rapi dan sesuai desain.          |        |
+----+--------------------------------+----------------------------------+----------------------------------+--------+

