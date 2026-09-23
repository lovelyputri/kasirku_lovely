{{-- Detail satu transaksi (tampilan struk: daftar item + total bayar) --}}
@extends('layouts.app')

@section('title', 'Detail Transaksi #' . $transaksi->id)

@section('content')

    {{-- ========================= CSS ========================= --}}
    <style>
        /* ========================= JUDUL ========================= */
        h4 {
            color: #647565;
            font-weight: 600;
        }

        /* =========================
           TOMBOL KEMBALI
           Cream pastel
        ========================= */
        .btn-kembali {
            background-color: #F3E2C7;
            border-color: #F3E2C7;
            color: #806B50;
            border-radius: 8px;
            padding: 6px 13px;
        }
        .btn-kembali:hover {
            background-color: #E8D2B0;
            border-color: #E8D2B0;
            color: #806B50;
        }

        /* =========================
           HEADER TABEL
           Pink pastel lembut
        ========================= */
        .table thead th {
            background-color: #F7E8EC;
            color: #687267;
            border-bottom: 2px solid #E8DDE0;
            padding: 12px;
        }

        /* ========================= ISI TABEL ========================= */
        .table tbody td {
            padding: 12px;
            border-color: #F0E5E8;
            color: #666666;
        }

        /* ========================= HARGA ========================= */
        .harga {
            color: #D88FA3;
            font-weight: 600;
        }

        /* =========================
           TOTAL BAYAR
           Hijau pastel
        ========================= */
        .total-row {
            background-color: #DCECCF;
            border-top: 2px solid #C9DFBD;
        }
        .total-row td {
            padding: 15px 12px;
            color: #60745A;
        }

        /* ========================= TOTAL HARGA ========================= */
        .total-harga {
            color: #60745A !important;
            font-size: 20px;
            font-weight: bold;
        }

        /* ========================= CARD ========================= */
        .card {
            border-radius: 15px;
        }
    </style>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card p-4">

                {{-- ========================= HEADER STRUK ========================= --}}
                <div class="d-flex justify-content-between align-items-start mb-4">

                    <div>
                        <h4 class="mb-1">Struk Transaksi #{{ $transaksi->id }}</h4>
                        <span class="text-muted">
                            {{ $transaksi->tanggal->format('d/m/Y H:i:s') }}
                        </span>
                    </div>

                    {{-- Tombol kembali --}}
                    <a href="{{ route('transaksi.index') }}" class="btn btn-kembali btn-sm">
                        &larr; Kembali
                    </a>

                </div>

                {{-- ========================= TABEL DETAIL TRANSAKSI ========================= --}}
                <div class="table-responsive">
                    <table class="table align-middle">

                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th class="text-center">Harga Satuan</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>

                        <tbody>
                            {{-- Loop semua detail transaksi --}}
                            @foreach ($transaksi->detailTransaksis as $detail)
                                <tr>

                                    {{-- Nama Produk --}}
                                    <td>
                                        {{ $detail->produk->nama_produk ?? '(produk terhapus)' }}
                                    </td>

                                    {{-- Harga Satuan --}}
                                    <td class="text-center harga">
                                        Rp {{ number_format($detail->produk->harga ?? 0, 0, ',', '.') }}
                                    </td>

                                    {{-- Jumlah --}}
                                    <td class="text-center">
                                        {{ $detail->jumlah }}
                                    </td>

                                    {{-- Subtotal --}}
                                    <td class="text-end harga">
                                        Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>

                        {{-- ========================= TOTAL BAYAR ========================= --}}
                        <tfoot>
                            <tr class="total-row">
                                <td colspan="3" class="fw-bold">TOTAL BAYAR</td>
                                <td class="text-end total-harga">
                                    Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}
                                </td>
                            </tr>
                        </tfoot>

                    </table>
                </div>

                {{-- ========================= FOOTER STRUK ========================= --}}
                <div class="text-center mt-4">
                    <small class="text-muted">
                        Terima kasih telah melakukan transaksi.
                    </small>
                </div>

            </div>
        </div>
    </div>

@endsection