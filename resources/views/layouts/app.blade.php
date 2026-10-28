<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Dashboard') - KoperasiKu</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }

        .topbar {
            height: 70px;
            padding: 0 30px;
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .brand {
            font-size: 23px;
            font-weight: bold;
            color: #1d4ed8;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logout-button {
            padding: 9px 14px;
            background: #dc2626;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .sidebar {
            position: fixed;
            top: 70px;
            bottom: 0;
            left: 0;
            width: 245px;
            padding: 24px 16px;
            background: #1e293b;
            color: white;
        }

        .sidebar-user {
            padding: 0 12px 24px;
            margin-bottom: 15px;
            border-bottom: 1px solid #475569;
        }

        .sidebar-user p {
            margin: 7px 0 0;
            color: #cbd5e1;
            font-size: 13px;
        }

        .sidebar a {
            display: block;
            padding: 13px 15px;
            margin-bottom: 7px;
            color: #e2e8f0;
            text-decoration: none;
            border-radius: 7px;
        }

        .sidebar a:hover {
            background: #334155;
            color: white;
        }

        .main-content {
            margin-left: 245px;
            padding: 30px;
            min-height: calc(100vh - 140px);
        }

        .page-heading {
            margin-bottom: 25px;
        }

        .page-heading h1 {
            margin: 0 0 10px;
            font-size: 28px;
        }

        .breadcrumb {
            color: #64748b;
            font-size: 14px;
        }

        .breadcrumb a {
            color: #2563eb;
            text-decoration: none;
        }

        .alert {
            padding: 14px 18px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .alert-success {
            color: #166534;
            background: #dcfce7;
        }

        .alert-danger {
            color: #991b1b;
            background: #fee2e2;
        }

        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .card {
            padding: 24px;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(15, 23, 42, 0.05);
        }

        .card h3 {
            margin-top: 0;
            color: #1d4ed8;
        }

        .card p {
            color: #64748b;
            line-height: 1.6;
        }

        .card a {
            display: inline-block;
            margin-top: 8px;
            padding: 10px 15px;
            color: white;
            background: #2563eb;
            text-decoration: none;
            border-radius: 6px;
        }

        .card a:hover {
            background: #1d4ed8;
        }

        .welcome-card {
            padding: 24px;
            background: white;
            border-left: 5px solid #2563eb;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(15, 23, 42, 0.05);
        }

        .welcome-card h3 {
            margin-top: 0;
        }

        footer {
            margin-left: 245px;
            padding: 20px 30px;
            background: white;
            border-top: 1px solid #e2e8f0;
            color: #64748b;
            font-size: 13px;
        }

        footer p {
            margin: 5px 0;
        }

        @media (max-width: 768px) {
            .topbar {
                padding: 0 15px;
            }

            .sidebar {
                position: static;
                width: 100%;
            }

            .main-content,
            footer {
                margin-left: 0;
            }

            .main-content {
                padding: 20px 15px;
            }

            .user-info {
                gap: 8px;
                font-size: 12px;
            }
        }
    </style>

    @stack('styles')
</head>
<body>

    <header class="topbar">
        <div class="brand">KoperasiKu</div>

        @auth
            <div class="user-info">
                <span>{{ auth()->user()->name }}</span>
                <span>({{ ucfirst(auth()->user()->role) }})</span>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="logout-button" type="submit">
                        Logout
                    </button>
                </form>
            </div>
        @endauth
    </header>

    <aside class="sidebar">
        @auth
            <div class="sidebar-user">
                <strong>{{ auth()->user()->name }}</strong>
                <p>{{ ucfirst(auth()->user()->role) }}</p>
            </div>
        @endauth

        <nav>
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('anggota.index') }}">Data Anggota</a>
            <a href="{{ route('simpanan.index') }}">Simpanan</a>
            <a href="{{ route('pinjaman.index') }}">Pinjaman</a>
            <a href="{{ route('angsuran.index') }}">Angsuran</a>

            @auth
                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('users.index') }}">Manajemen User</a>
                @endif
            @endauth
        </nav>
    </aside>

    <main class="main-content">
        <div class="page-heading">
            <h1>@yield('page-title', 'Dashboard')</h1>

            <div class="breadcrumb">
                <a href="{{ route('dashboard') }}">Home</a>
                / @yield('page-title', 'Dashboard')
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    <footer>
        <p>
            &copy; {{ date('Y') }} <strong>KoperasiKu.</strong>
            Sistem Informasi Koperasi Simpan Pinjam.
        </p>
        <p>Versi 1.0</p>
    </footer>

    @stack('scripts')

</body>
</html>
