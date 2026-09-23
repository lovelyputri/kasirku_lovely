{{-- Form tambah produk baru --}}
@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')

    {{-- ========================= CSS HALAMAN TAMBAH PRODUK ========================= --}}
    <style>
        /* ========================= JUDUL ========================= */
        h4 {
            color: #647565;
            font-weight: 600;
        }

        /* ========================= LABEL ========================= */
        .form-label {
            color: #6F756B;
            font-weight: 500;
        }

        /* ========================= INPUT ========================= */
        .form-control {
            border: 2px solid #E8DDE0;
            border-radius: 10px;
            padding: 10px 12px;
        }
        .form-control:focus {
            border-color: #E8B6C4;
            box-shadow: 0 0 0 3px rgba(232, 182, 196, 0.2);
        }

        /* =========================
           TOMBOL SIMPAN
           Pink pastel
        ========================= */
        .btn-simpan {
            background-color: #E8B6C4;
            border-color: #E8B6C4;
            color: #FFFFFF;
            padding: 9px 22px;
            border-radius: 9px;
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
            padding: 9px 22px;
            border-radius: 9px;
        }
        .btn-batal:hover {
            background-color: #E8D2B0;
            border-color: #E8D2B0;
            color: #806B50;
        }

        /* ========================= PESAN ERROR ========================= */
        .invalid-feedback {
            color: #A66A76;
        }
        .form-control.is-invalid {
            border-color: #E3AEB9;
            background-image: none;
        }
    </style>

    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="card p-4">

                {{-- Judul --}}
                <h4 class="mb-1">Tambah Produk</h4>
                <p class="text-muted mb-4">
                    Tambahkan produk baru ke dalam daftar produk.
                </p>

                {{-- Form --}}
                {{-- novalidate = menggunakan validasi dari Laravel --}}
                <form action="{{ route('produk.store') }}" method="POST" novalidate>
                    @csrf

                    {{-- ========================= NAMA PRODUK ========================= --}}
                    <div class="mb-3">
                        <label class="form-label">Nama Produk</label>
                        <input
                            type="text"
                            name="nama_produk"
                            class="form-control @error('nama_produk') is-invalid @enderror"
                            value="{{ old('nama_produk') }}"
                            placeholder="Contoh: Indomie Goreng"
                            required
                        >
                        @error('nama_produk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- ========================= HARGA ========================= --}}
                    <div class="mb-3">
                        <label class="form-label">Harga (Rp)</label>
                        <input
                            type="number"
                            name="harga"
                            min="0"
                            class="form-control @error('harga') is-invalid @enderror"
                            value="{{ old('harga') }}"
                            placeholder="Contoh: 3500"
                            required
                        >
                        @error('harga')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- ========================= STOK ========================= --}}
                    <div class="mb-4">
                        <label class="form-label">Stok</label>
                        <input
                            type="number"
                            name="stok"
                            min="0"
                            class="form-control @error('stok') is-invalid @enderror"
                            value="{{ old('stok') }}"
                            placeholder="Contoh: 100"
                            required
                        >
                        @error('stok')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- ========================= TOMBOL ========================= --}}
                    <div class="d-flex gap-2">

                        {{-- Simpan --}}
                        <button type="submit" class="btn btn-simpan">
                            Simpan
                        </button>

                        {{-- Batal --}}
                        <a href="{{ route('produk.index') }}" class="btn btn-batal">
                            Batal
                        </a>

                    </div>

                </form>

            </div>
        </div>
    </div>

@endsection