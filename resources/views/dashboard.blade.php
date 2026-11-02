
@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard Koperasi')

@section('content')

<div class="container-fluid">

    {{-- Sambutan --}}
    <div class="card card-primary card-outline mb-4">
        <div class="card-body">
            <h4 class="mb-1">
                Selamat Datang di KoperasiKu
            </h4>

            <p class="text-muted mb-0">
                Sistem Informasi Manajemen Koperasi.
                Kelola anggota, simpanan, pinjaman, dan angsuran
                dengan mudah melalui dashboard ini.
            </p>
        </div>
    </div>


    {{-- Kartu Statistik --}}
    <div class="row">

        {{-- Total Anggota --}}
        <div class="col-lg-3 col-md-6 col-12">
            <div class="small-box text-bg-primary">
                <div class="inner">
                    <h3>{{ $totalAnggota }}</h3>
                    <p>Total Anggota</p>
                </div>

                <i class="small-box-icon bi bi-people"></i>

                <a href="{{ route('anggota.index') }}"
                   class="small-box-footer link-light link-underline-opacity-0">
                    Lihat Anggota
                    <i class="bi bi-arrow-right-circle"></i>
                </a>
            </div>
        </div>


        {{-- Total Simpanan --}}
        <div class="col-lg-3 col-md-6 col-12">
            <div class="small-box text-bg-success">
                <div class="inner">
                    <h3>{{ $totalSimpanan }}</h3>
                    <p>Total Transaksi Simpanan</p>
                </div>

                <i class="small-box-icon bi bi-wallet2"></i>

                <a href="{{ route('simpanan.index') }}"
                   class="small-box-footer link-light link-underline-opacity-0">
                    Lihat Simpanan
                    <i class="bi bi-arrow-right-circle"></i>
                </a>
            </div>
        </div>


        {{-- Total Pinjaman --}}
        <div class="col-lg-3 col-md-6 col-12">
            <div class="small-box text-bg-warning">
                <div class="inner">
                    <h3>{{ $totalPinjaman }}</h3>
                    <p>Total Pinjaman</p>
                </div>

                <i class="small-box-icon bi bi-cash-stack"></i>

                <a href="{{ route('pinjaman.index') }}"
                   class="small-box-footer link-dark link-underline-opacity-0">
                    Lihat Pinjaman
                    <i class="bi bi-arrow-right-circle"></i>
                </a>
            </div>
        </div>


        {{-- Total Angsuran --}}
        <div class="col-lg-3 col-md-6 col-12">
            <div class="small-box text-bg-danger">
                <div class="inner">
                    <h3>{{ $totalAngsuran }}</h3>
                    <p>Total Transaksi Angsuran</p>
                </div>

                <i class="small-box-icon bi bi-receipt"></i>

                <a href="{{ route('angsuran.index') }}"
                   class="small-box-footer link-light link-underline-opacity-0">
                    Lihat Angsuran
                    <i class="bi bi-arrow-right-circle"></i>
                </a>
            </div>
        </div>

    </div>


    {{-- Daftar Anggota --}}
    <div class="card card-primary card-outline mt-3">

        <div class="card-header">
            <h3 class="card-title">
                <i class="bi bi-people me-2"></i>
                Daftar Anggota Koperasi
            </h3>

            <div class="card-tools">
                <a href="{{ route('anggota.index') }}"
                   class="btn btn-primary btn-sm">
                    <i class="bi bi-list-ul me-1"></i>
                    Semua Anggota
                </a>
            </div>
        </div>


        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-primary">
                        <tr>
                            <th style="width: 60px;">No.</th>
                            <th>Nomor Anggota</th>
                            <th>Nama Anggota</th>
                            <th>Email</th>
                            <th>Nomor HP</th>
                            <th>Status</th>
                        </tr>
                    </thead>


                    <tbody>

                        @forelse ($daftarAnggota as $anggota)

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    {{ $anggota->no_anggota ?? '-' }}
                                </td>

                                <td>
                                    <strong>
                                        {{ $anggota->nama }}
                                    </strong>
                                </td>

                                <td>
                                    {{ $anggota->email ?? '-' }}
                                </td>

                                <td>
                                    {{ $anggota->no_hp ?? '-' }}
                                </td>

                                <td>

                                    @if ($anggota->status === 'aktif')

                                        <span class="badge bg-success">
                                            Aktif
                                        </span>

                                    @else

                                        <span class="badge bg-danger">
                                            Nonaktif
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="text-center py-4">

                                    <i class="bi bi-inbox fs-2 text-muted"></i>

                                    <p class="text-muted mb-0 mt-2">
                                        Belum ada anggota yang terdaftar.
                                    </p>

                                    <a href="{{ route('anggota.create') }}"
                                       class="btn btn-primary btn-sm mt-2">
                                        <i class="bi bi-plus-circle me-1"></i>
                                        Tambah Anggota
                                    </a>

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


        <div class="card-footer text-muted">
            Total anggota terdaftar:
            <strong>{{ $totalAnggota }}</strong> orang.
        </div>

    </div>

</div>

@endsection
