{{-- Detail satu transaksi (tampilan struk: daftar item + total bayar) --}}
@extends('layouts.app')

@section('title', 'Detail Transaksi #' . $transaksi->id)

@section('content')

    {{-- ===== CSS HALAMAN DETAIL TRANSAKSI ===== --}}
    <style>
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

        /* ===== TOMBOL KEMBALI (cream / beige) ===== */
        .btn-kembali {
            background-color: #EFE3D8;
            border-color: #EFE3D8;
            color: #75645A;
            border-radius: 8px;
            padding: 6px 13px;
        }

        .btn-kembali:hover {
            background-color: #E3D3C5;
            border-color: #E3D3C5;
            color: #6B5A50;
        }

        /* ===== TABEL ===== */
        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background-color: #F7E8EC;
            color: #6B6064;
            font-weight: 600;
            border-bottom: 1px solid #EEDFE3;
            padding: 12px;
            vertical-align: middle;
        }

        .table tbody td {
            padding: 12px;
            color: #625B60;
            border-color: #F1E8E5;
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background-color: #FFF8F5;
        }

        /* ===== HARGA ===== */
        .harga {
            color: #C87590;
            font-weight: 600;
        }

        /* ===== TOTAL BAYAR (pink soft) ===== */
        .total-row {
            background-color: #F8E7ED;
            border-top: 1px solid #EBCBD6;
        }

        .total-row td {
            padding: 15px 12px;
            color: #875D6C;
        }

        .total-harga {
            color: #C87590 !important;
            font-size: 20px;
            font-weight: 600;
        }

        /* ===== FOOTER ===== */
        .card .text-center {
            color: #8A8082;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .d-flex.justify-content-between {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 15px;
            }

            .btn-kembali {
                width: 100%;
            }
        }
    </style>


    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card p-4">

                {{-- ===== HEADER STRUK ===== --}}
                <div class="d-flex justify-content-between align-items-start mb-4">

                    <div>
                        <h4 class="mb-1">Struk Transaksi {{ $transaksi->id }}</h4>

                        <span class="text-muted">
                            {{ $transaksi->tanggal->format('d/m/Y H:i:s') }}
                        </span>
                    </div>

                    {{-- Tombol kembali --}}
                    <a href="{{ route('transaksi.index') }}" class="btn btn-kembali btn-sm">
                        &larr; Kembali
                    </a>

                </div>


                {{-- ===== TABEL DETAIL TRANSAKSI ===== --}}
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

                                    {{-- Nama produk --}}
                                    <td>{{ $detail->produk->nama_produk ?? '(produk terhapus)' }}</td>

                                    {{-- Harga satuan --}}
                                    <td class="text-center harga">
                                        Rp {{ number_format($detail->produk->harga ?? 0, 0, ',', '.') }}
                                    </td>

                                    {{-- Jumlah --}}
                                    <td class="text-center">{{ $detail->jumlah }}</td>

                                    {{-- Subtotal --}}
                                    <td class="text-end harga">
                                        Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>

                        {{-- Total bayar --}}
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


                {{-- ===== FOOTER STRUK ===== --}}
                <div class="text-center mt-4">
                    <small class="text-muted">
                        Terima kasih telah melakukan transaksi.
                    </small>
                </div>

            </div>
        </div>
    </div>

@endsection
