{{-- Fitur 2: Form transaksi penjualan (pilih produk, masukkan jumlah, hitung total) --}}
@extends('layouts.app')

@section('title', 'Transaksi Baru')

@section('content')

    <style>
        /* ========================= JUDUL ========================= */
        h4 {
            color: #647565;
            font-weight: 600;
        }

        /* ========================= TABEL ========================= */
        #tabelItem {
            border-collapse: separate;
            border-spacing: 0;
        }
        #tabelItem thead th {
            background-color: #F7E8EC;
            color: #687267;
            border-bottom: 2px solid #E8DDE0;
            padding: 12px;
            vertical-align: middle;
        }
        #tabelItem tbody td {
            padding: 12px;
            border-color: #F0E5E8;
        }

        /*
         * PERBAIKAN POSISI BARIS ITEM
         *
         * Sebelumnya table memakai align-middle.
         * Karena kolom jumlah mempunyai input + teks "Maks. stok",
         * input terlihat lebih tinggi daripada dropdown.
         *
         * Sekarang semua isi baris dimulai dari posisi atas
         * sehingga dropdown, input, subtotal, dan tombol hapus sejajar.
         */
        #tabelItem tbody .baris-item > td {
            vertical-align: top !important;
        }

        /*
         * Supaya input dan dropdown benar-benar memiliki
         * tinggi yang sama.
         */
        #tabelItem .form-select,
        #tabelItem .form-control {
            min-height: 42px;
        }

        /* ========================= SELECT & INPUT ========================= */
        .form-select,
        .form-control {
            border: 2px solid #E8DDE0;
            border-radius: 10px;
        }
        .form-select:focus,
        .form-control:focus {
            border-color: #E8B6C4;
            box-shadow: 0 0 0 3px rgba(232, 182, 196, 0.2);
        }

        /* ========================= SUBTOTAL & HARGA ========================= */
        .harga {
            color: #D88FA3;
            font-weight: bold;
        }

        /*
         * Supaya subtotal sejajar dengan bagian atas input.
         */
        .subtotal-item {
            padding-top: 12px !important;
        }

        /* =========================
           TOMBOL TAMBAH ITEM
           Hijau pastel
        ========================= */
        .btn-tambah-item {
            background-color: #DCECCF;
            border-color: #DCECCF;
            color: #60745A;
            border-radius: 8px;
        }
        .btn-tambah-item:hover {
            background-color: #C9DFBD;
            border-color: #C9DFBD;
            color: #53664E;
        }

        /* =========================
           TOMBOL HAPUS BARIS
           Pink soft
        ========================= */
        .btn-hapus {
            background-color: #F4D5DC;
            border-color: #F4D5DC;
            color: #96616D;
            border-radius: 8px;
            font-size: 18px;
            line-height: 1;
        }
        .btn-hapus:hover {
            background-color: #EBC1CB;
            border-color: #EBC1CB;
            color: #855561;
        }

        /* =========================
           TOMBOL SIMPAN
           Pink pastel
        ========================= */
        .btn-simpan {
            background-color: #E8B6C4;
            border-color: #E8B6C4;
            color: #FFFFFF;
            border-radius: 9px;
            padding: 9px 20px;
        }
        .btn-simpan:hover {
            background-color: #D99AAA;
            border-color: #D99AAA;
            color: #FFFFFF;
        }

        /* =========================
           TOMBOL BATAL
           Cream pastel
        ========================= */
        .btn-batal {
            background-color: #F3E2C7;
            border-color: #F3E2C7;
            color: #806B50;
            border-radius: 9px;
            padding: 9px 20px;
        }
        .btn-batal:hover {
            background-color: #E8D2B0;
            border-color: #E8D2B0;
            color: #806B50;
        }

        /* ========================= PANEL RINGKASAN ========================= */
        .summary-card {
            background-color: #FFF9E8;
            border: 2px solid #F3E2C7;
            border-radius: 15px;
        }
        .summary-title {
            color: #647565;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* ========================= INFO STOK ========================= */
        .stok-info {
            display: block;
            margin-top: 4px;
            color: #819078 !important;
        }

        /* ========================= ALERT ERROR ========================= */
        .alert-danger {
            background-color: #FBE5EA;
            border-color: #F1C9D3;
            color: #9A6874;
        }

        /* ========================= RESPONSIVE ========================= */
        @media (max-width: 768px) {
            #tabelItem {
                min-width: 700px;
            }
        }
    </style>

    <div class="row">

        {{-- ========================= FORM TRANSAKSI ========================= --}}
        <div class="col-lg-8">
            <div class="card p-4">

                <h4 class="mb-1">Form Transaksi Penjualan</h4>
                <p class="text-muted mb-4">
                    Pilih produk dan masukkan jumlah barang yang dibeli.
                </p>

                {{-- Form transaksi --}}
                <form action="{{ route('transaksi.store') }}" method="POST" id="formTransaksi" novalidate>
                    @csrf

                    {{-- ========================= ERROR VALIDASI PRODUK ========================= --}}
                    @error('produk_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    {{-- ========================= TABEL ITEM ========================= --}}
                    <div class="table-responsive">
                        <table class="table align-middle" id="tabelItem">

                            <thead>
                                <tr>
                                    <th style="width: 55%">Produk</th>
                                    <th style="width: 20%">Jumlah Beli</th>
                                    <th class="text-end" style="width: 20%">Subtotal</th>
                                    <th style="width: 5%"></th>
                                </tr>
                            </thead>

                            <tbody>
                                {{-- ========================= BARIS ITEM PERTAMA ========================= --}}
                                <tr class="baris-item">

                                    {{-- ========================= PILIH PRODUK ========================= --}}
                                    <td>
                                        <select name="produk_id[]" class="form-select select-produk" required>
                                            <option value="">-- Pilih Produk --</option>
                                            @foreach ($produks as $produk)
                                                <option
                                                    value="{{ $produk->id }}"
                                                    data-harga="{{ $produk->harga }}"
                                                    data-stok="{{ $produk->stok }}"
                                                    data-nama="{{ $produk->nama_produk }}"
                                                >
                                                    {{ $produk->nama_produk }} — Rp {{ number_format($produk->harga, 0, ',', '.') }} (stok {{ $produk->stok }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>

                                    {{-- ========================= JUMLAH ========================= --}}
                                    <td>
                                        <input
                                            type="number"
                                            name="jumlah[]"
                                            class="form-control input-jumlah"
                                            min="1"
                                            value="1"
                                            required
                                        >
                                        <small class="text-muted stok-info"></small>
                                    </td>

                                    {{-- ========================= SUBTOTAL ========================= --}}
                                    <td class="text-end harga subtotal-item">
                                        Rp 0
                                    </td>

                                    {{-- ========================= HAPUS BARIS ========================= --}}
                                    <td>
                                        <button type="button" class="btn btn-sm btn-hapus" title="Hapus baris">
                                            &times;
                                        </button>
                                    </td>

                                </tr>
                            </tbody>

                        </table>
                    </div>

                    {{-- ========================= TAMBAH ITEM ========================= --}}
                    <button type="button" class="btn btn-tambah-item btn-sm" id="tambahItem">
                        + Tambah Item
                    </button>

                    {{-- ========================= TOMBOL FORM ========================= --}}
                    <div class="d-flex justify-content-end gap-2 mt-4">

                        {{-- Batal --}}
                        <a href="{{ route('produk.index') }}" class="btn btn-batal">
                            Batal
                        </a>

                        {{-- Simpan --}}
                        <button type="submit" class="btn btn-simpan btn-lg">
                            Simpan Transaksi
                        </button>

                    </div>

                </form>

            </div>
        </div>

        {{-- ========================= PANEL RINGKASAN ========================= --}}
        <div class="col-lg-4 mt-3 mt-lg-0">
            <div class="card p-4 summary-card">

                <h6 class="summary-title">Ringkasan</h6>

                <p class="mb-1 text-muted">
                    Jumlah item: <strong id="infoItem">0</strong>
                </p>

                <hr>

                <div class="d-flex justify-content-between align-items-center">
                    <span class="fs-5">Total Bayar</span>
                    <strong class="fs-4 harga" id="infoTotal">Rp 0</strong>
                </div>

                <p class="text-muted small mt-2 mb-0">
                    Total ini adalah perhitungan sementara.
                    Angka final tetap dihitung ulang oleh server
                    saat tombol <em>Simpan Transaksi</em> ditekan.
                </p>

            </div>
        </div>

    </div>

@endsection

{{-- ========================= JAVASCRIPT ========================= --}}
@push('scripts')
<script>
(function () {

    // ==========================================
    // FORMAT RUPIAH
    // Contoh: 3500 -> Rp 3.500
    // ==========================================
    const rupiah = n => 'Rp ' + Number(n).toLocaleString('id-ID');

    // ==========================================
    // ELEMENT
    // ==========================================
    const tbodyItem = document.querySelector('#tabelItem tbody');
    const infoTotal = document.getElementById('infoTotal');
    const infoItem = document.getElementById('infoItem');

    // ==========================================
    // HITUNG TOTAL
    // ==========================================
    function hitungTotal() {
        let total = 0;
        let item = 0;

        tbodyItem.querySelectorAll('.baris-item').forEach(baris => {
            const select = baris.querySelector('.select-produk');
            const jumlah = parseInt(baris.querySelector('.input-jumlah').value || 0, 10);
            const harga = parseInt(select.selectedOptions[0]?.dataset.harga || 0, 10);

            // Rumus: subtotal = harga x jumlah
            const subtotal = harga * jumlah;

            // Tampilkan subtotal
            baris.querySelector('.subtotal-item').textContent = rupiah(subtotal);

            // Tambahkan ke total
            total += subtotal;

            // Hitung jumlah baris yang sudah terisi
            if (select.value && jumlah > 0) {
                item++;
            }
        });

        // Tampilkan total
        infoTotal.textContent = rupiah(total);

        // Tampilkan jumlah item
        infoItem.textContent = item;
    }

    // ==========================================
    // BATASI STOK
    // ==========================================
    function batasiStok(baris) {
        const select = baris.querySelector('.select-produk');
        const input = baris.querySelector('.input-jumlah');
        const opsi = select.selectedOptions[0];

        if (opsi && opsi.dataset.stok) {
            const stok = parseInt(opsi.dataset.stok, 10);

            // Maksimal input = stok
            input.max = stok;

            // Tampilkan informasi stok
            baris.querySelector('.stok-info').textContent = 'Maks. ' + stok;

            // Kalau jumlah melebihi stok, otomatis disamakan dengan stok
            if (parseInt(input.value, 10) > stok) {
                input.value = stok;
            }
        } else {
            input.removeAttribute('max');
            baris.querySelector('.stok-info').textContent = '';
        }
    }

    // ==========================================
    // SAAT PRODUK DIGANTI
    // ==========================================
    tbodyItem.addEventListener('change', e => {
        if (e.target.matches('.select-produk')) {
            batasiStok(e.target.closest('.baris-item'));
        }
        hitungTotal();
    });

    // ==========================================
    // SAAT JUMLAH DIUBAH
    // ==========================================
    tbodyItem.addEventListener('input', e => {
        if (e.target.matches('.input-jumlah')) {
            hitungTotal();
        }
    });

    // ==========================================
    // HAPUS BARIS
    // ==========================================
    tbodyItem.addEventListener('click', e => {
        /*
         * Jangan hapus kalau hanya tersisa
         * satu baris.
         */
        if (e.target.matches('.btn-hapus') && tbodyItem.querySelectorAll('.baris-item').length > 1) {
            e.target.closest('.baris-item').remove();
            hitungTotal();
        }
    });

    // ==========================================
    // TAMBAH ITEM
    // ==========================================
    document.getElementById('tambahItem').addEventListener('click', () => {
        // Ambil baris pertama
        const barisBaru = tbodyItem.querySelector('.baris-item').cloneNode(true);

        // Reset produk
        barisBaru.querySelector('.select-produk').value = '';

        // Reset jumlah
        barisBaru.querySelector('.input-jumlah').value = 1;

        // Reset max stok
        barisBaru.querySelector('.input-jumlah').removeAttribute('max');

        // Reset informasi stok
        barisBaru.querySelector('.stok-info').textContent = '';

        // Reset subtotal
        barisBaru.querySelector('.subtotal-item').textContent = 'Rp 0';

        // Masukkan baris baru
        tbodyItem.appendChild(barisBaru);

        // Hitung ulang
        hitungTotal();
    });

    // ==========================================
    // VALIDASI SEBELUM SUBMIT
    // ==========================================
    document.getElementById('formTransaksi').addEventListener('submit', function (e) {
        const kosong = [...tbodyItem.querySelectorAll('.select-produk')].some(s => s.value === '');

        if (kosong) {
            e.preventDefault();
            alert('Semua baris harus memilih produk terlebih dahulu.');
        }
    });

    // ==========================================
    // HITUNG SAAT HALAMAN PERTAMA DIBUKA
    // ==========================================
    hitungTotal();

})();
</script>
@endpush