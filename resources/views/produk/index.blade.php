{{-- Fitur 1: Menampilkan daftar produk --}}
@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')

    {{-- ===== CSS HALAMAN PRODUK ===== --}}
    <style>
        /* ===== TOMBOL BUAT TRANSAKSI (pink utama) ===== */
        .btn-transaksi {
            background-color: #D98FA7;
            border-color: #D98FA7;
            color: #FFFFFF;
        }

        .btn-transaksi:hover {
            background-color: #C97892;
            border-color: #C97892;
            color: #FFFFFF;
        }

        /* ===== TOMBOL TAMBAH PRODUK (pink lebih lembut) ===== */
        .btn-tambah {
            background-color: #E5A9BC;
            border-color: #E5A9BC;
            color: #FFFFFF;
        }

        .btn-tambah:hover {
            background-color: #D48EA5;
            border-color: #D48EA5;
            color: #FFFFFF;
        }

        /* ===== TOMBOL EDIT (cream / beige) ===== */
        .btn-edit {
            background-color: #EFE3D8;
            border-color: #EFE3D8;
            color: #75645A;
        }

        .btn-edit:hover {
            background-color: #E3D3C5;
            border-color: #E3D3C5;
            color: #67574E;
        }

        /* ===== TOMBOL HAPUS (pink muda) ===== */
        .btn-hapus {
            background-color: #F3D4DE;
            border-color: #F3D4DE;
            color: #9A6072;
        }

        .btn-hapus:hover {
            background-color: #E9BFCC;
            border-color: #E9BFCC;
            color: #895467;
        }

        /* ===== JUDUL ===== */
        h4 {
            color: #B96882;
            font-weight: 600;
        }

        /* ===== DESKRIPSI KECIL ===== */
        .text-muted {
            color: #8A8082 !important;
        }

        /* ===== CARD TABEL ===== */
        .card {
            background-color: #FFFFFF;
            border: 1px solid #EEDCE2;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(190, 110, 135, 0.06);
        }

        /* ===== HEADER TABEL ===== */
        .table th {
            background-color: #F7E8EC;
            color: #6B6064;
            font-weight: 600;
            border-bottom: 1px solid #EEDFE3;
        }

        /* ===== ISI TABEL ===== */
        .table td {
            vertical-align: middle;
            color: #625B60;
            border-color: #F1E8E5;
        }

        /* ===== BARIS TABEL SAAT HOVER ===== */
        .table-hover tbody tr:hover {
            background-color: #FFF8F5;
        }

        /* ===== STOK TERSEDIA ===== */
        .badge-stok-tersedia {
            background-color: #f8dce7;
            color: #87576A;
            font-weight: 500;
        }

        /* ===== STOK HABIS ===== */
        .badge-stok-habis {
            background-color: #e7b8c4;
            color: #955E70;
            font-weight: 500;
        }

        /* ===== HARGA ===== */
        .harga {
            color: #C87590;
            font-weight: 600;
        }

        /* ===== PAGINATION ===== */
        .pagination {
            margin-bottom: 0;
        }

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
            color: #FFFFFF;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .d-flex.justify-content-between {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 15px;
            }

            .d-flex.justify-content-between > .d-flex {
                width: 100%;
            }

            .btn-transaksi,
            .btn-tambah {
                flex: 1;
            }
        }
    </style>


    {{-- ===== JUDUL DAN TOMBOL ===== --}}
    <div class="d-flex justify-content-between align-items-center mb-3">

        <div>
            <h4 class="mb-1">Daftar Produk</h4>
            <small class="text-muted">Master data barang yang dijual</small>
        </div>

        {{-- Tombol kanan --}}
        <div class="d-flex gap-2">
            <a href="{{ route('transaksi.create') }}" class="btn btn-transaksi">
                Buat Transaksi
            </a>

            <a href="{{ route('produk.create') }}" class="btn btn-tambah">
                + Tambah Produk
            </a>
        </div>

    </div>


    {{-- ===== TABEL PRODUK ===== --}}
    <div class="card p-3">

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">

                {{-- Kepala tabel --}}
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th class="text-end">Harga (Rp)</th>
                        <th class="text-center">Stok</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                {{-- Isi tabel --}}
                <tbody>
                    @forelse ($produks as $produk)
                        <tr>

                            {{-- ID produk --}}
                            <td>{{ $produk->id }}</td>

                            {{-- Nama produk --}}
                            <td>{{ $produk->nama_produk }}</td>

                            {{-- Harga --}}
                            <td class="text-end harga">
                                Rp {{ number_format($produk->harga, 0, ',', '.') }}
                            </td>

                            {{-- Stok --}}
                            <td class="text-center">
                                <span class="badge {{ $produk->stok > 0 ? 'badge-stok-tersedia' : 'badge-stok-habis' }}">
                                    {{ $produk->stok }}
                                </span>
                            </td>

                            {{-- Aksi --}}
                            <td class="text-center">

                                {{-- Tombol edit --}}
                                <a href="{{ route('produk.edit', $produk) }}" class="btn btn-sm btn-edit">
                                    Edit
                                </a>

                                {{-- Tombol hapus --}}
                                <form
                                    action="{{ route('produk.destroy', $produk) }}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Hapus produk {{ $produk->nama_produk }}?');"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-sm btn-hapus">
                                        Hapus
                                    </button>
                                </form>

                            </td>

                        </tr>
                    @empty
                        {{-- Kalau belum ada produk --}}
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                Belum ada produk. Tambahkan dulu.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-3">
            {{ $produks->links('pagination::bootstrap-5') }}
        </div>

    </div>

@endsection
