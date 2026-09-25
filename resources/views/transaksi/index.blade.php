{{-- Fitur 3: Halaman/tabel riwayat transaksi + rangkuman total penjualan --}}
@extends('layouts.app')
@section('title', 'Riwayat Transaksi')
@section('content')

    <style>
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

        /* ===== JUDUL ===== */
        h4 {
            color: #B96882;
            font-weight: 600;
        }

        /* ===== DESKRIPSI KECIL ===== */
        .text-muted {
            color: #8A8082 !important;
        }

        /* ===== CARD RANGKUMAN ===== */
        .summary-card {
            border-radius: 15px;
            border: 1px solid #EEDCE2;
            box-shadow: 0 4px 12px rgba(190, 110, 135, 0.06);
            transition: 0.2s ease;
        }

        .summary-card:hover {
            transform: translateY(-2px);
        }

        /* Total penjualan (pink) */
        .summary-pink {
            background-color: #FBEAF0;
            border-color: #F3D5DF;
        }

        /* Jumlah transaksi (nuansa pink) */
        .summary-green {
            background-color: #F8E7ED;
            border-color: #EBCBD6;
        }

        /* Total unit (cream) */
        .summary-cream {
            background-color: #FFF9F3;
            border-color: #EEDFD6;
        }

        /* Teks summary */
        .summary-card small {
            color: #8A8082 !important;
        }

        .summary-card strong {
            color: #625B60;
        }

        /* ===== HARGA ===== */
        .harga {
            color: #C87590;
            font-weight: 600;
        }

        /* ===== TOMBOL DETAIL ===== */
        .btn-detail {
            background-color: #E5A9BC;
            border-color: #E5A9BC;
            color: #FFFFFF;
        }

        .btn-detail:hover {
            background-color: #D48EA5;
            border-color: #D48EA5;
            color: #FFFFFF;
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

            .btn-transaksi,
            .summary-card {
                width: 100%;
            }
        }
    </style>


    {{-- ===== JUDUL DAN TOMBOL ===== --}}
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


    {{-- ===== RANGKUMAN PENJUALAN ===== --}}
    <div class="row g-3 mb-4">

        {{-- Total penjualan --}}
        <div class="col-md-4">
            <div class="card summary-card summary-pink p-3 text-center">
                <small class="text-muted text-uppercase">Total Penjualan</small>

                <strong class="fs-4 harga">
                    Rp {{ number_format($totalPenjualan, 0, ',', '.') }}
                </strong>
            </div>
        </div>

        {{-- Jumlah transaksi --}}
        <div class="col-md-4">
            <div class="card summary-card summary-green p-3 text-center">
                <small class="text-muted text-uppercase">Jumlah Transaksi</small>

                <strong class="fs-4">{{ $jumlahTransaksi }} nota</strong>
            </div>
        </div>

        {{-- Total unit terjual --}}
        <div class="col-md-4">
            <div class="card summary-card summary-cream p-3 text-center">
                <small class="text-muted text-uppercase">Total Unit Terjual</small>

                <strong class="fs-4">{{ $totalUnitTerjual }} item</strong>
            </div>
        </div>

    </div>


    {{-- ===== TABEL RIWAYAT TRANSAKSI ===== --}}
    <div class="card p-3">

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">

                {{-- Kepala tabel --}}
                <thead>
                    <tr>
                        <th>No</th>
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

                            {{-- Nomor urut transaksi --}}
                            <td> {{ $transaksis->firstItem() + $loop->index }} </td>

                            {{-- Tanggal --}}
                            <td>{{ $transaksi->tanggal->format('d/m/Y H:i') }}</td>

                            {{-- Jumlah item --}}
                            <td class="text-center">
                                {{ $transaksi->detailTransaksis->count() }} item
                            </td>

                            {{-- Total bayar --}}
                            <td class="text-end harga">
                                Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}
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

        {{-- Pagination --}}
        <div class="mt-3">
            {{ $transaksis->links('pagination::bootstrap-5') }}
        </div>

    </div>

@endsection
