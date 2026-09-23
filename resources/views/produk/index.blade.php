{{-- Fitur 1: Menampilkan daftar produk --}}
@extends('layouts.app')

@section('title', 'Daftar Produk')

@section('content')

    {{-- ========================= CSS HALAMAN PRODUK ========================= --}}
    <style>
        /* =========================
           TOMBOL BUAT TRANSAKSI
           Hijau pastel
        ========================= */
        .btn-transaksi {
            background-color: #DCECCF;
            border-color: #DCECCF;
            color: #60745A;
        }
        .btn-transaksi:hover {
            background-color: #C9DFBD;
            border-color: #C9DFBD;
            color: #53664E;
        }

        /* =========================
           TOMBOL TAMBAH PRODUK
           Pink pastel
        ========================= */
        .btn-tambah {
            background-color: #E8B6C4;
            border-color: #E8B6C4;
            color: white;
        }
        .btn-tambah:hover {
            background-color: #D99AAA;
            border-color: #D99AAA;
            color: white;
        }

        /* =========================
           TOMBOL EDIT
           Cream / peach pastel
        ========================= */
        .btn-edit {
            background-color: #F3E2C7;
            border-color: #F3E2C7;
            color: #806B50;
        }
        .btn-edit:hover {
            background-color: #E8D2B0;
            border-color: #E8D2B0;
            color: #806B50;
        }

        /* =========================
           TOMBOL HAPUS
           Pink muda
        ========================= */
        .btn-hapus {
            background-color: #F4D5DC;
            border-color: #F4D5DC;
            color: #96616D;
        }
        .btn-hapus:hover {
            background-color: #EBC1CB;
            border-color: #EBC1CB;
            color: #96616D;
        }

        /* ========================= JUDUL ========================= */
        h4 {
            color: #647565;
        }

        /* ========================= HARGA ========================= */
        .harga {
            color: #D88FA3;
            font-weight: bold;
        }
    </style>

    {{-- ========================= JUDUL DAN TOMBOL ========================= --}}
    <div class="d-flex justify-content-between align-items-center mb-3">

        <div>
            <h4 class="mb-1">Daftar Produk</h4>
            <small class="text-muted">Master data barang yang dijual</small>
        </div>

        {{-- Tombol kanan --}}
        <div class="d-flex gap-2">

            {{-- Tombol Buat Transaksi --}}
            <a href="{{ route('transaksi.create') }}" class="btn btn-transaksi">
                Buat Transaksi
            </a>

            {{-- Tombol Tambah Produk --}}
            <a href="{{ route('produk.create') }}" class="btn btn-tambah">
                + Tambah Produk
            </a>

        </div>

    </div>

    {{-- ========================= TABEL PRODUK ========================= --}}
    <div class="card p-3">

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">

                {{-- Kepala tabel --}}
                <thead>
                    <tr>
                        <th>#</th>
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

                            {{-- ID Produk --}}
                            <td>{{ $produk->id }}</td>

                            {{-- Nama Produk --}}
                            <td>{{ $produk->nama_produk }}</td>

                            {{-- Harga --}}
                            <td class="text-end harga">
                                Rp {{ number_format($produk->harga, 0, ',', '.') }}
                            </td>

                            {{-- Stok --}}
                            <td class="text-center">
                                <span class="badge {{ $produk->stok > 0 ? 'bg-success' : 'bg-danger' }}">
                                    {{ $produk->stok }}
                                </span>
                            </td>

                            {{-- ========================= AKSI ========================= --}}
                            <td class="text-center">

                                {{-- Tombol Edit --}}
                                <a href="{{ route('produk.edit', $produk) }}" class="btn btn-sm btn-edit">
                                    Edit
                                </a>

                                {{-- Tombol Hapus --}}
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

        {{-- ========================= PAGINATION ========================= --}}
        <div class="mt-3">
            {{ $produks->links('pagination::bootstrap-5') }}
        </div>

    </div>

@endsection