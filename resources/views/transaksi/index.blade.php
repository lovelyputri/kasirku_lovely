{{-- Fitur 3: Halaman/tabel riwayat transaksi + rangkuman total penjualan --}}
@extends('layouts.app')

@section('title', 'Riwayat Transaksi')

@section('content')

    {{-- ========================= CSS HALAMAN RIWAYAT ========================= --}}
    <style>
        /* ========================= JUDUL ========================= */
        h4 {
            color: #647565;
            font-weight: 600;
        }

        /* =========================
           TOMBOL TRANSAKSI BARU
           Hijau pastel
        ========================= */
        .btn-transaksi {
            background-color: #DCECCF;
            border-color: #DCECCF;
            color: #60745A;
            border-radius: 9px;
            padding: 9px 16px;
        }
        .btn-transaksi:hover {
            background-color: #C9DFBD;
            border-color: #C9DFBD;
            color: #53664E;
        }

        /* ========================= CARD RANGKUMAN ========================= */
        .summary-card {
            border-radius: 15px;
            border: 2px solid transparent;
            transition: 0.2s ease;
        }
        .summary-card:hover {
            transform: translateY(-2px);
        }

        /* =========================
           TOTAL PENJUALAN
           Pink pastel
        ========================= */
        .summary-pink {
            background-color: #FBEAF0;
            border-color: #F3D5DF;
        }

        /* =========================
           JUMLAH TRANSAKSI
           Hijau pastel
        ========================= */
        .summary-green {
            background-color: #EDF5E8;
            border-color: #DCECCF;
        }

        /* =========================
           TOTAL UNIT
           Cream pastel
        ========================= */
        .summary-cream {
            background-color: #FFF5E4;
            border-color: #F3E2C7;
        }

        /* ========================= HARGA ========================= */
        .harga {
            color: #D88FA3;
            font-weight: bold;
        }

        /* =========================
           TOMBOL DETAIL
           Pink pastel
        ========================= */
        .btn-detail {
            background-color: #E8B6C4;
            border-color: #E8B6C4;
            color: #FFFFFF;
            border-radius: 8px;
            padding: 6px 14px;
        }
        .btn-detail:hover {
            background-color: #D99AAA;
            border-color: #D99AAA;
            color: #FFFFFF;
        }

        /* ========================= TABEL ========================= */
        .table th {
            background-color: #F7E8EC;
            color: #687267;
            border-bottom: 2px solid #E8DDE0;
        }
        .table td {
            color: #666666;
        }

        /* ========================= PAGINATION ========================= */
        .page-link {
            color: #D88FA3;
            background-color: #FFFFFF;
            border-color: #F0DCE2;
        }
        .page-link:hover {
            color: #FFFFFF;
            background-color: #E8B6C4;
            border-color: #E8B6C4;
        }
        .page-item.active .page-link {
            background-color: #E8B6C4;
            border-color: #E8B6C4;
            color: #FFFFFF;
        }
    </style>

    {{-- ========================= JUDUL DAN TOMBOL ========================= --}}
    <div class="d-flex justify-content-between align-items-center mb-3">

        <div>
            <h4 class="mb-1">Riwayat Transaksi</h4>
            <small class="text-muted">Catatan seluruh penjualan yang pernah dilakukan</small>
        </div>

        {{-- Tombol transaksi baru --}}
        <a href="{{ route('transaksi.create') }}" class="btn btn-transaksi">
            + Transaksi Baru
        </a>

    </div>

    {{-- ========================= RANGKUMAN PENJUALAN ========================= --}}
    <div class="row g-3 mb-4">

        {{-- Total Penjualan --}}
        <div class="col-md-4">
            <div class="card summary-card summary-pink p-3 text-center">
                <small class="text-muted text-uppercase">Total Penjualan</small>
                <strong class="fs-4 harga">
                    Rp {{ number_format($totalPenjualan, 0, ',', '.') }}
                </strong>
            </div>
        </div>

        {{-- Jumlah Transaksi --}}
        <div class="col-md-4">
            <div class="card summary-card summary-green p-3 text-center">
                <small class="text-muted text-uppercase">Jumlah Transaksi</small>
                <strong class="fs-4">{{ $jumlahTransaksi }} nota</strong>
            </div>
        </div>

        {{-- Total Unit Terjual --}}
        <div class="col-md-4">
            <div class="card summary-card summary-cream p-3 text-center">
                <small class="text-muted text-uppercase">Total Unit Terjual</small>
                <strong class="fs-4">{{ $totalUnitTerjual }} item</strong>
            </div>
        </div>

    </div>

    {{-- ========================= TABEL RIWAYAT TRANSAKSI ========================= --}}
    <div class="card p-3">

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">

                {{-- Kepala tabel --}}
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th class="text-center">Jumlah Item</th>
                        <th class="text-end">Total Bayar (Rp)</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                {{-- Isi tabel --}}
                <tbody>
                    @forelse ($transaksis as $transaksi)
                        <tr>

                            {{-- ID Transaksi --}}
                            <td>#{{ $transaksi->id }}</td>

                            {{-- Tanggal --}}
                            <td>{{ $transaksi->tanggal->format('d/m/Y H:i') }}</td>

                            {{-- Jumlah Item --}}
                            <td class="text-center">
                                {{ $transaksi->detailTransaksis->count() }} item
                            </td>

                            {{-- Total Bayar --}}
                            <td class="text-end harga">
                                <strong>
                                    Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}
                                </strong>
                            </td>

                            {{-- Aksi --}}
                            <td class="text-center">
                                <a href="{{ route('transaksi.show', $transaksi) }}" class="btn btn-sm btn-detail">
                                    Detail
                                </a>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                Belum ada transaksi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        {{-- ========================= PAGINATION ========================= --}}
        <div class="mt-3">
            {{ $transaksis->links('pagination::bootstrap-5') }}
        </div>

    </div>

@endsection