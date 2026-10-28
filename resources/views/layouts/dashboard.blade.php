
@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard Koperasi')

@section('content')

    {{-- Kartu Menu Dashboard --}}
    <div class="dashboard-cards">

        {{-- Kartu Anggota --}}
        <div class="card">
            <h3>Anggota</h3>
            <p>Data Anggota Koperasi</p>

            <a href="{{ route('anggota.index') }}">
                Lihat Data
            </a>
        </div>

        {{-- Kartu Simpanan --}}
        <div class="card">
            <h3>Simpanan</h3>
            <p>Transaksi Simpanan Anggota</p>

            <a href="{{ route('simpanan.index') }}">
                Lihat Simpanan
            </a>
        </div>

        {{-- Kartu Pinjaman --}}
        <div class="card">
            <h3>Pinjaman</h3>
            <p>Kelola pengajuan, jumlah, dan status pinjaman anggota.</p>

            <a href="{{ route('pinjaman.index') }}">
                Lihat Pinjaman
            </a>

            <a href="{{ route('pinjaman.create') }}">
                Tambah Pinjaman
            </a>
        </div>

        {{-- Kartu Angsuran --}}
        <div class="card">
            <h3>Angsuran</h3>
            <p>Kelola pembayaran angsuran pinjaman anggota.</p>

            <a href="{{ route('angsuran.index') }}">
                Lihat Angsuran
            </a>
        </div>

        {{-- Kartu Pengguna khusus Admin --}}
        @if (auth()->user()?->role === 'admin')
            <div class="card">
                <h3>Pengguna</h3>
                <p>Manajemen pengguna aplikasi KoperasiKu.</p>

                <a href="{{ route('users.index') }}">
                    Kelola User
                </a>
            </div>
        @endif

    </div>

    {{-- Pesan Selamat Datang --}}
    <div class="welcome-card">
        <h3>Selamat Datang</h3>

        <p>
            Selamat datang,
            <strong>{{ auth()->user()->name }}</strong>,
            di aplikasi KoperasiKu.
        </p>

        <p>
            Silakan gunakan menu di atas untuk mengelola
            data anggota, simpanan, pinjaman, dan angsuran koperasi.
        </p>
    </div>

@endsection
