{{-- Fitur 2: Form transaksi penjualan (pilih produk, masukkan jumlah, hitung total) --}}
@extends('layouts.app')

@section('title', 'Transaksi Baru')

@section('content')

    {{-- ===== CSS HALAMAN TRANSAKSI BARU ===== --}}
    <style>
        /* ===== VARIABEL SPASI ===== */
        :root {
            --kontrol-tinggi: 42px;
            --sel-padding-y: 14px;
            --sel-padding-x: 12px;
        }

        /* ===== JUDUL ===== */
        h4 {
            color: #B96882;
            font-weight: 600;
        }

        .text-muted {
            color: #8A8082 !important;
        }

        /* ===== CARD ===== */
        .card {
            background-color: #FFFFFF;
            border: 1px solid #EEDCE2;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(190, 110, 135, 0.06);
        }

        /* ===== TABEL ===== */
        #tabelItem {
            width: 100%;
            table-layout: fixed;
            border-collapse: separate;
            border-spacing: 0;
        }

        #tabelItem thead th {
            background-color: #F7E8EC;
            color: #6B6064;
            font-weight: 600;
            border-bottom: 1px solid #EEDFE3;
            padding: var(--sel-padding-x);
            vertical-align: middle;
            white-space: nowrap;
        }

        #tabelItem tbody td {
            padding: var(--sel-padding-y) var(--sel-padding-x);
            color: #625B60;
            border-color: #F1E8E5;
            vertical-align: top;
        }

        #tabelItem tbody tr:hover {
            background-color: #FFF8F5;
        }

        /* ===== SELECT & INPUT ===== */
        .form-select,
        .form-control {
            height: var(--kontrol-tinggi);
            min-height: var(--kontrol-tinggi);
            padding-top: 0;
            padding-bottom: 0;
            border: 1px solid #E7D8D5;
            border-radius: 10px;
            background-color: #FFFFFF;
            color: #625B60;
        }

        .form-select:focus,
        .form-control:focus {
            border-color: #D98FA7;
            box-shadow: 0 0 0 3px rgba(217, 143, 167, 0.18);
        }

        /* ===== SUBTOTAL / HARGA ===== */
        .harga {
            color: #C87590;
            font-weight: 600;
        }

        .subtotal-item {
            line-height: var(--kontrol-tinggi);
            white-space: nowrap;
        }

        /* ===== INFO STOK ===== */
        .stok-info {
            display: block;
            min-height: 1.25rem;
            margin-top: 6px;
            font-size: 0.8rem;
            line-height: 1.25rem;
            color: #8A8082 !important;
        }

        /* ===== TOMBOL TAMBAH ITEM ===== */
        .btn-tambah-item {
            margin-top: 16px;
            padding: 8px 14px;
            font-size: 0.875rem;
            background-color: #E5A9BC;
            border-color: #E5A9BC;
            color: #FFFFFF;
            border-radius: 8px;
        }

        .btn-tambah-item:hover {
            background-color: #D48EA5;
            border-color: #D48EA5;
            color: #FFFFFF;
        }

        /* ===== TOMBOL HAPUS ===== */
        .btn-hapus {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: var(--kontrol-tinggi);
            height: var(--kontrol-tinggi);
            padding: 0;
            background-color: #F3D4DE;
            border-color: #F3D4DE;
            color: #955E70;
            border-radius: 8px;
            font-size: 20px;
            line-height: 1;
        }

        .btn-hapus:hover {
            background-color: #E9BFCC;
            border-color: #E9BFCC;
            color: #8A5365;
        }

        /* ===== AREA TOMBOL FORM ===== */
        .aksi-form {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid #F1E8E5;
        }

        .btn-simpan,
        .btn-batal {
            padding: 10px 22px;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 9px;
        }

        .btn-simpan {
            background-color: #D98FA7;
            border-color: #D98FA7;
            color: #FFFFFF;
        }

        .btn-simpan:hover {
            background-color: #C97892;
            border-color: #C97892;
            color: #FFFFFF;
        }

        .btn-batal {
            background-color: #EFE3D8;
            border-color: #EFE3D8;
            color: #75645A;
        }

        .btn-batal:hover {
            background-color: #E3D3C5;
            border-color: #E3D3C5;
            color: #6B5A50;
        }

        /* ===== PANEL RINGKASAN ===== */
        .summary-card {
            background-color: #FFFFFF;
            border: 1px solid #EEDCE2;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(190, 110, 135, 0.06);
        }

        .summary-title {
            color: #B96882;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .summary-card hr {
            margin: 16px 0;
            border-color: #EEDCE2;
            opacity: 1;
        }

        /* ===== ALERT ERROR ===== */
        .alert-danger {
            margin-bottom: 16px;
            padding: 12px 16px;
            background-color: #F9E2E8;
            border: 1px solid #EDC5D0;
            color: #955B6B;
            border-radius: 10px;
        }

        /* ===== TOMBOL X ALERT ===== */
        .btn-alert-close {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            width: 28px;
            height: 28px;
            margin-left: 15px;
            padding: 0;
            border: none;
            background: transparent;
            color: #1d1a1a;
            font-size: 25px;
            font-weight: 400;
            line-height: 1;
            cursor: pointer;
            opacity: 0.75;
        }

        .btn-alert-close:hover {
            color: #000000;
            opacity: 1;
        }

        /* ===== PAGINATION ===== */
        .page-link {
            color: #C87590;
            background-color: #FFFFFF;
            border-color: #EEDCE2;
        }

        .page-link:hover {
            color: #FFFFFF;
            background-color: #D98FA7;
            border-color: #D98FA7;
        }

        .page-item.active .page-link {
            background-color: #D98FA7;
            border-color: #D98FA7;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            #tabelItem {
                min-width: 700px;
            }

            .aksi-form {
                flex-direction: column;
            }

            .btn-batal,
            .btn-simpan,
            .btn-tambah-item {
                width: 100%;
            }
        }
    </style>



    {{-- ===== NOTIF ERROR JUMLAH ===== --}}

    @if ($errors->has('jumlah.*'))

        <div class="alert alert-danger d-flex justify-content-between align-items-center">
            <span>
                Jumlah beli harus lebih dari 0.
            </span>

            <button type="button" class="btn-alert-close" onclick="this.parentElement.remove()" aria-label="Tutup">
                &times;
            </button>
        </div>

    @endif


    <div class="row">

        {{-- ===== FORM TRANSAKSI ===== --}}
        <div class="col-lg-8">
            <div class="card p-4">

                <h4 class="mb-1">
                    Form Transaksi Penjualan
                </h4>

                <p class="text-muted mb-4">
                    Pilih produk dan masukkan jumlah barang yang dibeli.
                </p>

                <form action="{{ route('transaksi.store') }}" method="POST" id="formTransaksi" novalidate>
                    @csrf

                    {{-- ===== TABEL ITEM ===== --}}
                    <div class="table-responsive">

                        <table class="table align-middle mb-0" id="tabelItem">

                            <colgroup>
                                <col>
                                <col style="width: 130px">
                                <col style="width: 160px">
                                <col style="width: 66px">
                            </colgroup>

                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Jumlah Beli</th>
                                    <th class="text-end">Subtotal</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>

                                {{-- ===== BARIS ITEM ===== --}}
                                <tr class="baris-item">

                                    {{-- Produk --}}
                                    <td>

                                        <select name="produk_id[]" class="form-select select-produk" required>

                                            <option value="">
                                                -- Pilih Produk --
                                            </option>

                                            @foreach ($produks as $produk)

                                                <option value="{{ $produk->id }}" data-harga="{{ $produk->harga }}" data-stok="{{ $produk->stok }}" data-nama="{{ $produk->nama_produk }}">
                                                    {{ $produk->nama_produk }}
                                                    —
                                                    Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                                    (stok {{ $produk->stok }})
                                                </option>

                                            @endforeach

                                        </select>

                                    </td>


                                    {{-- Jumlah --}}
                                    <td>
                                        <input type="number" name="jumlah[]" class="form-control input-jumlah" value="1" required>
                                        <small class="text-muted stok-info"></small>

                                    </td>


                                    {{-- Subtotal --}}
                                    <td class="text-end harga subtotal-item">
                                        Rp 0
                                    </td>


                                    {{-- Hapus --}}
                                    <td class="text-center">

                                        <button type="button" class="btn btn-hapus" title="Hapus baris">
                                            &times;
                                        </button>

                                    </td>

                                </tr>

                            </tbody>

                        </table>

                    </div>


                    {{-- ===== TAMBAH ITEM ===== --}}
                    <button
                        type="button"
                        class="btn btn-tambah-item"
                        id="tambahItem"
                    >
                        + Tambah Item
                    </button>


                    {{-- ===== TOMBOL FORM ===== --}}
                    <div class="aksi-form">
                        <a href="{{ route('transaksi.index') }}" class="btn btn-batal">
                            Batal
                        </a>

                        <button type="submit" class="btn btn-simpan">
                            Simpan Transaksi
                        </button>

                    </div>

                </form>

            </div>
        </div>


        {{-- ===== PANEL RINGKASAN ===== --}}
        <div class="col-lg-4 mt-3 mt-lg-0">

            <div class="card p-4 summary-card">

                <h6 class="summary-title mb-3">
                    Ringkasan
                </h6>

                <p class="mb-0 text-muted">
                    Jumlah item:
                    <strong id="infoItem">0</strong>
                </p>

                <hr>

                <div class="d-flex justify-content-between align-items-center">

                    <span class="fs-5">
                        Total Bayar
                    </span>

                    <strong class="fs-4 harga" id="infoTotal">
                        Rp 0
                    </strong>

                </div>

                <p class="text-muted small mt-3 mb-0">
                    Total ini adalah perhitungan sementara.
                    Angka final tetap dihitung ulang oleh server
                    saat tombol <em>Simpan Transaksi</em> ditekan.
                </p>

            </div>

        </div>

    </div>

@endsection


{{-- ===== JAVASCRIPT ===== --}}
@push('scripts')

<script>
    (function () {

        // ----- Format rupiah -----
        const rupiah = n =>
            'Rp ' + Number(n).toLocaleString('id-ID');


        // ----- Element -----
        const tbodyItem =
            document.querySelector('#tabelItem tbody');

        const infoTotal =
            document.getElementById('infoTotal');

        const infoItem =
            document.getElementById('infoItem');


        // ----- Hitung total -----
        function hitungTotal() {

            let total = 0;
            let item = 0;

            tbodyItem
                .querySelectorAll('.baris-item')
                .forEach(baris => {

                    const select =
                        baris.querySelector('.select-produk');

                    const jumlah =
                        parseInt(
                            baris.querySelector('.input-jumlah').value || 0,
                            10
                        );

                    const harga =
                        parseInt(
                            select.selectedOptions[0]?.dataset.harga || 0,
                            10
                        );


                    // Subtotal per baris
                    const subtotal = harga * jumlah;

                    baris.querySelector(
                        '.subtotal-item'
                    ).textContent = rupiah(subtotal);


                    total += subtotal;


                    // Hitung item yang sudah terisi
                    if (select.value && jumlah > 0) {
                        item++;
                    }

                });


            infoTotal.textContent =
                rupiah(total);

            infoItem.textContent =
                item;
        }


        // ----- Batasi jumlah sesuai stok -----
        function batasiStok(baris) {

            const select =
                baris.querySelector('.select-produk');

            const input =
                baris.querySelector('.input-jumlah');

            const info =
                baris.querySelector('.stok-info');

            const opsi =
                select.selectedOptions[0];


            if (opsi && opsi.dataset.stok) {

                const stok =
                    parseInt(
                        opsi.dataset.stok,
                        10
                    );


                input.max = stok;

                info.textContent =
                    'Maks. ' + stok;


                // Jika jumlah melebihi stok
                if (
                    parseInt(input.value, 10) > stok
                ) {

                    input.value = stok;

                }

            } else {

                input.removeAttribute('max');

                info.textContent = '';

            }
        }


        // ----- Saat produk diganti -----
        tbodyItem.addEventListener('change', e => {

            if (
                e.target.matches('.select-produk')
            ) {

                batasiStok(
                    e.target.closest('.baris-item')
                );

            }

            hitungTotal();

        });


        // ----- Saat jumlah diubah -----
        tbodyItem.addEventListener('input', e => {

            if (
                !e.target.matches('.input-jumlah')
            ) {
                return;
            }

            hitungTotal();

        });


        // ----- Hapus baris -----
        tbodyItem.addEventListener('click', e => {

            if (
                e.target.matches('.btn-hapus') &&
                tbodyItem.querySelectorAll('.baris-item').length > 1
            ) {

                e.target
                    .closest('.baris-item')
                    .remove();

                hitungTotal();

            }

        });


        // ----- Tambah item -----
        document
            .getElementById('tambahItem')
            .addEventListener('click', () => {

                // Salin baris pertama
                const barisBaru =
                    tbodyItem
                        .querySelector('.baris-item')
                        .cloneNode(true);


                // Reset produk
                barisBaru.querySelector(
                    '.select-produk'
                ).value = '';


                // Reset jumlah
                barisBaru.querySelector(
                    '.input-jumlah'
                ).value = 1;


                // Hapus batas stok
                barisBaru.querySelector(
                    '.input-jumlah'
                ).removeAttribute('max');


                // Reset info stok
                barisBaru.querySelector(
                    '.stok-info'
                ).textContent = '';


                // Reset subtotal
                barisBaru.querySelector(
                    '.subtotal-item'
                ).textContent = 'Rp 0';


                tbodyItem.appendChild(barisBaru);

                hitungTotal();

            });


        // ----- Validasi sebelum submit -----
        document
            .getElementById('formTransaksi')
            .addEventListener('submit', function (e) {

                const kosong =
                    [
                        ...tbodyItem.querySelectorAll('.select-produk')
                    ].some(s => s.value === '');


                if (kosong) {

                    e.preventDefault();

                    alert(
                        'Semua baris harus memilih produk terlebih dahulu.'
                    );

                }

            });


        // ----- Hitung saat halaman dibuka -----
        hitungTotal();

    })();
</script>

@endpush
