
<!DOCTYPE html>
<html lang="id" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard') - KoperasiKu</title>

    {{-- ADMINLTE DAN ASET APLIKASI --}}
    @vite([
        'resources/css/adminlte.css',
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/js/adminlte.js'
    ])

    {{-- CSS TAMBAHAN SETIAP HALAMAN --}}
    @stack('styles')

    <style>
        /* =====================================
           TEMA DASAR ADMINLTE
        ===================================== */

        html,
        body {
            color-scheme: light;
            background-color: #f4f6f9 !important;
            color: #334155;
        }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
        }

        .app-wrapper {
            background-color: #f4f6f9 !important;
            min-height: 100vh;
        }

        /* =====================================
           NAVBAR
        ===================================== */

        .app-header {
            background-color: #ffffff !important;
            border-bottom: 1px solid #e2e8f0;
        }

        .app-header .nav-link {
            color: #334155;
        }

        .app-header .nav-link:hover {
            color: #2563eb;
        }

        .brand-text {
            color: #ffffff;
            font-size: 20px;
        }

        /* =====================================
           SIDEBAR
        ===================================== */

        .app-sidebar {
            background-color: #1e293b !important;
        }

        .sidebar-brand {
            background-color: #1e293b;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-brand .brand-link {
            color: #ffffff;
        }

        .sidebar-wrapper {
            background-color: #1e293b;
        }

        .sidebar-wrapper .nav-link {
            color: #cbd5e1;
            border-radius: 6px;
            margin: 3px 8px;
            transition: 0.2s;
        }

        .sidebar-wrapper .nav-link:hover {
            background-color: #334155;
            color: #ffffff;
        }

        .sidebar-wrapper .nav-link.active {
            background-color: #2563eb;
            color: #ffffff;
        }

        .sidebar-wrapper .nav-icon {
            margin-right: 8px;
        }

        /* =====================================
           KONTEN UTAMA
        ===================================== */

        .app-main {
            background-color: #f4f6f9 !important;
        }

        .app-content-header {
            background-color: #f4f6f9 !important;
            padding: 20px 0;
        }

        .app-content-header h3 {
            color: #1e293b;
            font-weight: 700;
        }

        .app-content {
            background-color: #f4f6f9 !important;
            padding-bottom: 25px;
        }

        /* =====================================
           DASHBOARD
        ===================================== */

        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .dashboard-cards .card {
            padding: 24px;
            background-color: #ffffff !important;
            color: #334155;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.05);
        }

        .dashboard-cards .card h3 {
            margin-top: 0;
            color: #2563eb;
            font-size: 20px;
        }

        .dashboard-cards .card p {
            color: #64748b;
            line-height: 1.6;
        }

        .welcome-card {
            padding: 24px;
            background-color: #ffffff !important;
            color: #334155;
            border-left: 5px solid #2563eb;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.05);
        }

        /* =====================================
           TOMBOL DASHBOARD
        ===================================== */

        .card-actions {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .card-actions a {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            min-width: 135px;
            padding: 10px 16px;
            color: #ffffff;
            background-color: #2563eb;
            border: 1px solid #2563eb;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
        }

        .card-actions a:hover {
            background-color: #1d4ed8;
            color: #ffffff;
        }

        /* =====================================
           KARTU DAN TABEL
        ===================================== */

        .card {
            border-radius: 10px;
            border-color: #e2e8f0;
            box-shadow: 0 3px 10px rgba(15, 23, 42, 0.04);
        }

        .card-header {
            background-color: #ffffff;
            border-bottom: 1px solid #e2e8f0;
        }

        .table {
            color: #334155;
        }

        /* =====================================
           FOOTER
        ===================================== */

        .app-footer {
            background-color: #ffffff !important;
            color: #64748b !important;
            border-top: 1px solid #e2e8f0;
        }

        .app-footer a {
            color: #2563eb;
            font-weight: 600;
        }

        /* =====================================
           ALERT
        ===================================== */

        .alert {
            border-radius: 8px;
        }

        /* =====================================
           RESPONSIVE
        ===================================== */

        @media (max-width: 992px) {
            .dashboard-cards {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 576px) {
            .dashboard-cards {
                grid-template-columns: 1fr;
            }

            .app-content {
                padding: 12px;
            }

            .app-content-header {
                padding: 15px 0;
            }

            .app-header .nav-link {
                font-size: 13px;
            }
        }
    </style>

</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">

    <div class="app-wrapper">

        {{-- =====================================
             NAVBAR / HEADER
        ====================================== --}}

        <nav class="app-header navbar navbar-expand bg-white shadow-sm">

            <div class="container-fluid">

                <ul class="navbar-nav">

                    {{-- TOMBOL SIDEBAR --}}
                    <li class="nav-item">
                        <a class="nav-link"
                           data-lte-toggle="sidebar"
                           href="#"
                           role="button">
                            <i class="bi bi-list fs-4"></i>
                        </a>
                    </li>

                    {{-- LOGO --}}
                    <li class="nav-item d-flex align-items-center">
                        <a href="{{ route('dashboard') }}"
                           class="nav-link fw-bold text-primary fs-5">
                            KoperasiKu
                        </a>
                    </li>

                </ul>


                {{-- INFORMASI PENGGUNA --}}
                @auth

                    <ul class="navbar-nav ms-auto align-items-center">

                        <li class="nav-item me-3">
                            <span class="nav-link">
                                {{ auth()->user()->name }}

                                <span class="text-muted">
                                    ({{ ucfirst(auth()->user()->role) }})
                                </span>
                            </span>
                        </li>

                        {{-- LOGOUT --}}
                        <li class="nav-item">

                            <form action="{{ route('logout') }}" method="POST">
                                @csrf

                                <button type="submit"
                                        class="btn btn-danger btn-sm">

                                    <i class="bi bi-box-arrow-right me-1"></i>
                                    Logout

                                </button>
                            </form>

                        </li>

                    </ul>

                @endauth

            </div>

        </nav>


        {{-- =====================================
             SIDEBAR
        ====================================== --}}

        <aside class="app-sidebar bg-dark shadow"
               data-bs-theme="dark">

            {{-- BRAND SIDEBAR --}}
            <div class="sidebar-brand">

                <a href="{{ route('dashboard') }}"
                   class="brand-link">

                    <span class="brand-text fw-light">
                        <strong>KoperasiKu</strong>
                    </span>

                </a>

            </div>


            <div class="sidebar-wrapper">

                {{-- INFORMASI USER --}}
                @auth

                    <div class="px-3 py-3 border-bottom border-secondary">

                        <div class="text-white fw-bold">
                            {{ auth()->user()->name }}
                        </div>

                        <small class="text-white-50">
                            {{ ucfirst(auth()->user()->role) }}
                        </small>

                    </div>

                @endauth


                {{-- MENU --}}
                <nav class="mt-2">

                    <ul class="nav sidebar-menu flex-column"
                        data-lte-toggle="treeview"
                        role="menu">


                        {{-- DASHBOARD --}}
                        <li class="nav-item">

                            <a href="{{ route('dashboard') }}"
                               class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">

                                <i class="nav-icon bi bi-speedometer2"></i>

                                <p>Dashboard</p>

                            </a>

                        </li>


                        {{-- DATA ANGGOTA --}}
                        <li class="nav-item">

                            <a href="{{ route('anggota.index') }}"
                               class="nav-link {{ request()->routeIs('anggota.*') ? 'active' : '' }}">

                                <i class="nav-icon bi bi-people"></i>

                                <p>Data Anggota</p>

                            </a>

                        </li>


                        {{-- SIMPANAN --}}
                        <li class="nav-item">

                            <a href="{{ route('simpanan.index') }}"
                               class="nav-link {{ request()->routeIs('simpanan.*') ? 'active' : '' }}">

                                <i class="nav-icon bi bi-wallet2"></i>

                                <p>Simpanan</p>

                            </a>

                        </li>


                        {{-- PINJAMAN --}}
                        <li class="nav-item">

                            <a href="{{ route('pinjaman.index') }}"
                               class="nav-link {{ request()->routeIs('pinjaman.*') ? 'active' : '' }}">

                                <i class="nav-icon bi bi-cash-stack"></i>

                                <p>Pinjaman</p>

                            </a>

                        </li>


                        {{-- ANGSURAN --}}
                        <li class="nav-item">

                            <a href="{{ route('angsuran.index') }}"
                               class="nav-link {{ request()->routeIs('angsuran.*') ? 'active' : '' }}">

                                <i class="nav-icon bi bi-calendar-check"></i>

                                <p>Angsuran</p>

                            </a>

                        </li>


                        {{-- MANAJEMEN USER KHUSUS ADMIN --}}
                        @auth

                            @if (auth()->user()->role === 'admin')

                                <li class="nav-item">

                                    <a href="{{ route('users.index') }}"
                                       class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">

                                        <i class="nav-icon bi bi-person-gear"></i>

                                        <p>Manajemen User</p>

                                    </a>

                                </li>

                            @endif

                        @endauth

                    </ul>

                </nav>

            </div>

        </aside>


        {{-- =====================================
             KONTEN UTAMA
        ====================================== --}}

        <main class="app-main">


            {{-- JUDUL HALAMAN --}}
            <div class="app-content-header">

                <div class="container-fluid">

                    <div class="row">

                        <div class="col-sm-6">

                            <h3 class="mb-0">
                                @yield('page-title', 'Dashboard')
                            </h3>

                        </div>


                        {{-- BREADCRUMB --}}
                        <div class="col-sm-6">

                            <ol class="breadcrumb float-sm-end">

                                <li class="breadcrumb-item">

                                    <a href="{{ route('dashboard') }}">
                                        Home
                                    </a>

                                </li>

                                <li class="breadcrumb-item active">

                                    @yield('title', 'Dashboard')

                                </li>

                            </ol>

                        </div>

                    </div>

                </div>

            </div>


            {{-- ISI KONTEN --}}
            <div class="app-content">

                <div class="container-fluid">


                    {{-- NOTIFIKASI BERHASIL --}}
                    @if (session('success'))

                        <div class="alert alert-success alert-dismissible fade show"
                             role="alert">

                            <i class="bi bi-check-circle me-2"></i>

                            {{ session('success') }}

                            <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="alert"
                                    aria-label="Close">
                            </button>

                        </div>

                    @endif


                    {{-- NOTIFIKASI ERROR --}}
                    @if (session('error'))

                        <div class="alert alert-danger alert-dismissible fade show"
                             role="alert">

                            <i class="bi bi-exclamation-circle me-2"></i>

                            {{ session('error') }}

                            <button type="button"
                                    class="btn-close"
                                    data-bs-dismiss="alert"
                                    aria-label="Close">
                            </button>

                        </div>

                    @endif


                    {{-- VALIDASI FORM --}}
                    @if ($errors->any())

                        <div class="alert alert-danger" role="alert">

                            <strong>
                                Periksa kembali data yang dimasukkan.
                            </strong>

                            <ul class="mb-0 mt-2">

                                @foreach ($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                    @endif


                    {{-- KONTEN MASING-MASING HALAMAN --}}
                    @yield('content')


                </div>

            </div>

        </main>


        {{-- =====================================
             FOOTER
        ====================================== --}}

        <footer class="app-footer">

            <div class="float-end d-none d-sm-inline">
                Versi 1.0
            </div>

            <strong>

                &copy; {{ date('Y') }}

                <a href="{{ route('dashboard') }}"
                   class="text-decoration-none">

                    KoperasiKu

                </a>.

            </strong>

            Sistem Informasi Koperasi Simpan Pinjam.

        </footer>

    </div>


    {{-- JAVASCRIPT TAMBAHAN --}}
    @stack('scripts')

</body>

</html>
