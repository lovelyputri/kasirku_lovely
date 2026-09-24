{{-- Form tambah produk baru --}}
@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')

    {{-- ===== CSS HALAMAN TAMBAH PRODUK ===== --}}
    <style>
        /* ===== CARD ===== */
        .card {
            background-color: #FFFFFF;
            border: 1px solid #EEDCE2;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(190, 110, 135, 0.06);
        }

        /* ===== JUDUL ===== */
        h4 {
            color: #B96882;
            font-weight: 600;
        }

        /* ===== LABEL ===== */
        .form-label {
            color: #6B6064;
            font-weight: 500;
        }

        /* ===== INPUT ===== */
        .form-control {
            border: 1px solid #E7D8D5;
            border-radius: 10px;
            padding: 10px 12px;
            background-color: #FFFFFF;
            color: #625B60;
        }

        .form-control::placeholder {
            color: #AAA0A3;
        }

        .form-control:focus {
            border-color: #D98FA7;
            box-shadow: 0 0 0 3px rgba(217, 143, 167, 0.18);
        }

        /* ===== TOMBOL SIMPAN (pink utama) ===== */
        .btn-simpan {
            background-color: #D98FA7;
            border-color: #D98FA7;
            color: #FFFFFF;
            padding: 9px 22px;
            border-radius: 9px;
        }

        .btn-simpan:hover {
            background-color: #C97892;
            border-color: #C97892;
            color: #FFFFFF;
        }

        /* ===== TOMBOL BATAL (cream / beige) ===== */
        .btn-batal {
            background-color: #EFE3D8;
            border-color: #EFE3D8;
            color: #75645A;
            padding: 9px 22px;
            border-radius: 9px;
        }

        .btn-batal:hover {
            background-color: #E3D3C5;
            border-color: #E3D3C5;
            color: #67574E;
        }

        /* ===== PESAN ERROR ===== */
        .invalid-feedback {
            color: #A15F72;
        }

        .form-control.is-invalid {
            border-color: #E3AEB9;
            background-image: none;
        }

        /* ===== DESKRIPSI ===== */
        .text-muted {
            color: #8A8082 !important;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 576px) {
            .card {
                padding: 20px !important;
            }

            .btn-simpan,
            .btn-batal {
                flex: 1;
            }
        }
    </style>


    {{-- ===== FORM ===== --}}
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            <div class="card p-4">

                {{-- Judul --}}
                <h4 class="mb-1">Tambah Produk</h4>

                <p class="text-muted mb-4">
                    Tambahkan produk baru ke dalam daftar produk.
                </p>

                <form action="{{ route('produk.store') }}" method="POST" novalidate>
                    @csrf

                    {{-- Nama produk --}}
                    <div class="mb-3">
                        <label class="form-label">Nama Produk</label>

                        <input type="text" name="nama_produk" class="form-control @error('nama_produk') is-invalid @enderror" value="{{ old('nama_produk') }}" placeholder="Contoh: Mascara Waterprof" required>

                        @error('nama_produk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Harga --}}
                    <div class="mb-3">
                        <label class="form-label">Harga (Rp)</label>

                        <input type="number" name="harga" min="0" class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga') }}" placeholder="Contoh: 3500" required>

                        @error('harga')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Stok --}}
                    <div class="mb-4">
                        <label class="form-label">Stok</label>

                        <input type="number" name="stok" min="0" class="form-control @error('stok') is-invalid @enderror" value="{{ old('stok') }}" placeholder="Contoh: 100" required>

                        @error('stok')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tombol --}}
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-simpan">Simpan</button>
                        <a href="{{ route('produk.index') }}" class="btn btn-batal">Batal</a>
                    </div>

                </form>

            </div>
        </div>
    </div>

@endsection
