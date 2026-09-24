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
        /* ===== WARNA DASAR ===== */
        body {
            background-color: #FFF9F3;
            color: #625B60;
        }

        /* ===== NAVBAR ===== */
        .navbar {
            background-color: #F8DDE5 !important;
            position: relative;
        }

        .navbar-brand {
            color: #B96882 !important;
            font-weight: bold;
            position: absolute;
            left: 5%;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
        }

        .navbar .nav-link {
            color: #75656B !important;
            padding-left: 14px;
            padding-right: 14px;
        }

        .navbar .nav-link:hover {
            color: #C87590 !important;
        }

        .navbar .nav-link.active {
            color: #C87590 !important;
            font-weight: bold;
        }

        .navbar .navbar-collapse {
            justify-content: center;
        }

        .navbar .navbar-nav {
            margin-left: auto !important;
            margin-right: auto !important;
        }

        /* ===== CARD ===== */
        .card {
            background-color: #FFFFFF;
            border: 1px solid #F0D4DD;
            border-radius: 15px;
            box-shadow: 0 3px 10px rgba(190, 110, 135, 0.08);
        }

        /* ===== TABEL ===== */
        .table th {
            background-color: #FBE9EE;
            color: #695D63;
            border: none;
        }

        .table td {
            vertical-align: middle;
        }

        /* ===== HARGA ===== */
        .harga {
            color: #C87590;
            font-weight: bold;
        }

        /* ===== TOMBOL PRIMARY ===== */
        .btn-primary {
            background-color: #D98FA7;
            border-color: #D98FA7;
            color: #FFFFFF;
        }

        .btn-primary:hover {
            background-color: #C97892;
            border-color: #C97892;
            color: #FFFFFF;
        }

        /* ===== TOMBOL SECONDARY ===== */
        .btn-secondary {
            background-color: #EAD9D0;
            border-color: #EAD9D0;
            color: #6D5D59;
        }

        .btn-secondary:hover {
            background-color: #DDC6BB;
            border-color: #DDC6BB;
            color: #5F514D;
        }

        /* ===== TOMBOL SUCCESS ===== */
        .btn-success {
            background-color: #DCA7B8;
            border-color: #DCA7B8;
            color: #FFFFFF;
        }

        .btn-success:hover {
            background-color: #CA8D9F;
            border-color: #CA8D9F;
            color: #FFFFFF;
        }

        /* ===== ALERT ===== */
        .alert-success {
            background-color: #F8E7ED;
            border-color: #EBCBD6;
            color: #875D6C;
        }

        .alert-danger {
            background-color: #F9E2E8;
            border-color: #EDC5D0;
            color: #955B6B;
        }

        /* ===== BADGE ===== */
        .bg-success {
            background-color: #E7C3CF !important;
            color: #80576A !important;
        }

        .bg-danger {
            background-color: #F1CBD5 !important;
            color: #8F5968 !important;
        }

        /* ===== INPUT FORM ===== */
        .form-control,
        .form-select {
            border: 1px solid #E7D8D5;
            border-radius: 10px;
            background-color: #FFFFFF;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #D98FA7;
            box-shadow: 0 0 0 3px rgba(217, 143, 167, 0.18);
        }

        /* ===== JUDUL ===== */
        h1, h2, h3, h4, h5 {
            color: #665B60;
        }

        /* ===== LINK ===== */
        a {
            color: #C87590;
        }

        a:hover {
            color: #A95E77;
        }

        /* ===== PAGINATION ===== */
        .page-link {
            color: #C87590;
            background-color: #FFFFFF;
            border-color: #EDD7DE;
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

        /* ===== MOBILE ===== */
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

    {{-- ===== NAVBAR ===== --}}
    <nav class="navbar navbar-expand-lg mb-4">
        <div class="container">

            {{-- Logo / nama aplikasi --}}
            <a class="navbar-brand" href="{{ route('home') }}">
                🧾 Kasirku
            </a>

            {{-- Tombol menu HP --}}
            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- Menu navbar --}}
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav">

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home', 'produk.*') ? 'active' : '' }}" href="{{ route('produk.index') }}">
                            Daftar Produk
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('transaksi.create') ? 'active' : '' }}" href="{{ route('transaksi.create') }}">
                            Transaksi Baru
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('transaksi.index', 'transaksi.show') ? 'active' : '' }}" href="{{ route('transaksi.index') }}">
                            Riwayat Transaksi
                        </a>
                    </li>

                </ul>
            </div>

        </div>
    </nav>


    {{-- ===== ISI HALAMAN ===== --}}
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
