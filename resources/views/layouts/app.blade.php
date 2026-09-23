{{-- Layout utama aplikasi LokkaPay --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - {{ config('app.name', 'LokkaPay') }}</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* ========================= WARNA DASAR ========================= */
        body {
            background-color: #FFF9E8;
            color: #5F5F5F;
        }

        /* ========================= NAVBAR ========================= */
        .navbar {
            background-color: #DCECCF !important;
            position: relative;
        }

        /*
         * LOGO
         * Tetap berada di sebelah kiri.
         */
        .navbar-brand {
            color: #5F7560 !important;
            font-weight: bold;
            position: absolute;
            left: 10%;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
        }

        .navbar .nav-link {
            color: #647565 !important;
            padding-left: 14px;
            padding-right: 14px;
        }
        .navbar .nav-link:hover {
            color: #D88FA3 !important;
        }
        .navbar .nav-link.active {
            color: #D88FA3 !important;
            font-weight: bold;
        }

        /*
         * MENU NAVBAR
         * Dibuat benar-benar berada di tengah.
         */
        .navbar .navbar-collapse {
            justify-content: center;
        }
        .navbar .navbar-nav {
            margin-left: auto !important;
            margin-right: auto !important;
        }

        /* ========================= CARD ========================= */
        .card {
            background-color: white;
            border: 2px solid #F3DDE4;
            border-radius: 15px;
            box-shadow: 0 3px 10px rgba(120, 100, 100, 0.08);
        }

        /* ========================= TABEL ========================= */
        .table th {
            background-color: #F7E8EC;
            color: #687267;
            border: none;
        }
        .table td {
            vertical-align: middle;
        }

        /* ========================= HARGA ========================= */
        .harga {
            color: #D88FA3;
            font-weight: bold;
        }

        /* ========================= TOMBOL PRIMARY ========================= */
        .btn-primary {
            background-color: #E8B6C4;
            border-color: #E8B6C4;
            color: white;
        }
        .btn-primary:hover {
            background-color: #D99AAA;
            border-color: #D99AAA;
            color: white;
        }

        /* ========================= TOMBOL SUCCESS ========================= */
        .btn-success {
            background-color: #BFDDB5;
            border-color: #BFDDB5;
            color: #557052;
        }
        .btn-success:hover {
            background-color: #AACCA0;
            border-color: #AACCA0;
            color: #557052;
        }

        /* ========================= PESAN BERHASIL ========================= */
        .alert-success {
            background-color: #E5F1DC;
            border-color: #CFE3C5;
            color: #60765A;
        }

        /* ========================= PESAN ERROR ========================= */
        .alert-danger {
            background-color: #FBE5EA;
            border-color: #F1C9D3;
            color: #9A6874;
        }

        /* ========================= BADGE STOK ========================= */
        .bg-success {
            background-color: #CFE5C7 !important;
            color: #587054 !important;
        }
        .bg-danger {
            background-color: #F4D5DC !important;
            color: #96616D !important;
        }

        /* ========================= INPUT FORM ========================= */
        .form-control,
        .form-select {
            border: 2px solid #E8DDE0;
            border-radius: 10px;
        }
        .form-control:focus,
        .form-select:focus {
            border-color: #E8B6C4;
            box-shadow: 0 0 0 3px rgba(232, 182, 196, 0.2);
        }

        /* ========================= JUDUL ========================= */
        h1, h2, h3, h4, h5 {
            color: #647565;
        }

        /* ========================= LINK ========================= */
        a {
            color: #D88FA3;
        }
        a:hover {
            color: #B9788C;
        }

        /* ========================= PAGINATION ========================= */
        .page-link {
            color: #D88FA3;
            background-color: white;
            border-color: #F0DCE2;
        }
        .page-link:hover {
            color: white;
            background-color: #E8B6C4;
            border-color: #E8B6C4;
        }
        .page-item.active .page-link {
            background-color: #E8B6C4;
            border-color: #E8B6C4;
        }

        /* ========================= NAVBAR MOBILE ========================= */
        @media (max-width: 991.98px) {
            .navbar-brand {
                position: static;
                transform: none;
            }
            .navbar .navbar-collapse {
                text-align: center;
            }
            .navbar .navbar-nav {
                margin-left: auto !important;
                margin-right: auto !important;
                align-items: center;
            }
        }
    </style>
</head>

<body>

    {{-- ========================= NAVBAR ========================= --}}
    <nav class="navbar navbar-expand-lg mb-4">
        <div class="container">

            {{-- ========================= LOGO / NAMA APLIKASI (Tetap di kiri) ========================= --}}
            <a class="navbar-brand" href="{{ route('home') }}">
                🛍️ LokkaPay
            </a>

            {{-- ========================= TOMBOL MENU HP ========================= --}}
            <button
                class="navbar-toggler ms-auto"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navMenu"
                aria-controls="navMenu"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- ========================= MENU (Berada di tengah navbar) ========================= --}}
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav">

                    {{-- Daftar Produk --}}
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home', 'produk.*') ? 'active' : '' }}" href="{{ route('produk.index') }}">
                            Daftar Produk
                        </a>
                    </li>

                    {{-- Transaksi Baru --}}
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('transaksi.create') ? 'active' : '' }}" href="{{ route('transaksi.create') }}">
                            Transaksi Baru
                        </a>
                    </li>

                    {{-- Riwayat Transaksi --}}
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('transaksi.index', 'transaksi.show') ? 'active' : '' }}" href="{{ route('transaksi.index') }}">
                            Riwayat Transaksi
                        </a>
                    </li>

                </ul>
            </div>

        </div>
    </nav>

    {{-- ========================= ISI HALAMAN ========================= --}}
    <main class="container pb-5">

        {{-- Pesan berhasil --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Pesan error --}}
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Isi halaman lain --}}
        @yield('content')

    </main>

    {{-- Bootstrap JavaScript --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Script tambahan dari halaman lain --}}
    @stack('scripts')

</body>
</html>