
@extends('layouts.app')

@section('title', 'Detail Pinjaman')

@section('page-title', 'Detail Pinjaman')

@section('content')

@php
    $status = strtolower($pinjaman->status ?? 'diajukan');

    $statusLabel = [
        'diajukan' => 'Menunggu Persetujuan',
        'disetujui' => 'Disetujui',
        'ditolak' => 'Ditolak',
        'dicairkan' => 'Sudah Dicairkan',
        'lunas' => 'Lunas',
    ];

    $statusColor = [
        'diajukan' => 'warning',
        'disetujui' => 'info',
        'ditolak' => 'danger',
        'dicairkan' => 'primary',
        'lunas' => 'success',
    ];
@endphp

<div class="container-fluid">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Detail Pinjaman</h4>
            <p class="text-muted mb-0">
                Informasi lengkap pinjaman anggota koperasi.
            </p>
        </div>

        <a href="{{ route('pinjaman.index') }}"
           class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>
            Kembali
        </a>
    </div>


    {{-- Ringkasan Pinjaman --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                <div>
                    <span class="text-muted">Nama Anggota</span>

                    <h3 class="fw-bold mt-1 mb-1">
                        {{ $pinjaman->anggota->nama ?? '-' }}
                    </h3>

                    <span class="text-muted">
                        No. Anggota:
                        {{ $pinjaman->anggota->no_anggota ?? '-' }}
                    </span>
                </div>

                <div class="text-md-end">
                    <span class="text-muted d-block mb-2">
                        Status Pinjaman
                    </span>

                    <span class="badge bg-{{ $statusColor[$status] ?? 'secondary' }} px-3 py-2 fs-6">
                        {{ $statusLabel[$status] ?? ucfirst($status) }}
                    </span>
                </div>

            </div>

            <hr class="my-4">

            <div class="row g-3">

                <div class="col-md-4">
                    <div class="p-3 rounded bg-light h-100">
                        <div class="text-muted small">
                            Jumlah Pengajuan
                        </div>
                        <h4 class="fw-bold text-primary mt-2 mb-0">
                            Rp {{ number_format($pinjaman->jumlah_pengajuan ?? 0, 0, ',', '.') }}
                        </h4>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 rounded bg-light h-100">
                        <div class="text-muted small">
                            Jumlah Disetujui
                        </div>
                        <h4 class="fw-bold text-success mt-2 mb-0">
                            Rp {{ number_format($pinjaman->jumlah_disetujui ?? 0, 0, ',', '.') }}
                        </h4>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 rounded bg-light h-100">
                        <div class="text-muted small">
                            Jumlah Pencairan
                        </div>
                        <h4 class="fw-bold text-info mt-2 mb-0">
                            Rp {{ number_format($pinjaman->jumlah_pencairan ?? 0, 0, ',', '.') }}
                        </h4>
                    </div>
                </div>

            </div>
        </div>
    </div>


    {{-- Informasi Pinjaman dan Anggota --}}
    <div class="row g-4 mb-4">

        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">

                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-cash-stack text-primary me-2"></i>
                        Informasi Pinjaman
                    </h5>
                </div>

                <div class="card-body">

                    <div class="d-flex justify-content-between border-bottom py-3">
                        <span class="text-muted">ID Pinjaman</span>
                        <strong>#{{ $pinjaman->id }}</strong>
                    </div>

                    <div class="d-flex justify-content-between border-bottom py-3">
                        <span class="text-muted">Bunga Pinjaman</span>
                        <strong>{{ $pinjaman->bunga_persen }}%</strong>
                    </div>

                    <div class="d-flex justify-content-between border-bottom py-3">
                        <span class="text-muted">Lama Pinjaman</span>
                        <strong>{{ $pinjaman->tenor_bulan }} Bulan</strong>
                    </div>

                    <div class="d-flex justify-content-between border-bottom py-3">
                        <span class="text-muted">Tanggal Pengajuan</span>
                        <strong>
                            {{ $pinjaman->created_at?->format('d-m-Y') ?? '-' }}
                        </strong>
                    </div>

                    <div class="d-flex justify-content-between border-bottom py-3">
                        <span class="text-muted">Tanggal Pencairan</span>
                        <strong>
                            {{ $pinjaman->tanggal_pencairan
                                ? \Carbon\Carbon::parse($pinjaman->tanggal_pencairan)->format('d-m-Y')
                                : '-' }}
                        </strong>
                    </div>

                    <div class="d-flex justify-content-between py-3">
                        <span class="text-muted">Tanggal Pelunasan</span>
                        <strong>
                            {{ $pinjaman->tanggal_pelunasan
                                ? \Carbon\Carbon::parse($pinjaman->tanggal_pelunasan)->format('d-m-Y')
                                : '-' }}
                        </strong>
                    </div>

                </div>
            </div>
        </div>


        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">

                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold mb-0">
                        <i class="bi bi-person-circle text-primary me-2"></i>
                        Informasi Anggota
                    </h5>
                </div>

                <div class="card-body">

                    <div class="d-flex justify-content-between border-bottom py-3">
                        <span class="text-muted">Nama Anggota</span>
                        <strong>{{ $pinjaman->anggota->nama ?? '-' }}</strong>
                    </div>

                    <div class="d-flex justify-content-between border-bottom py-3">
                        <span class="text-muted">Nomor Anggota</span>
                        <strong>{{ $pinjaman->anggota->no_anggota ?? '-' }}</strong>
                    </div>

                    <div class="d-flex justify-content-between border-bottom py-3">
                        <span class="text-muted">Email</span>
                        <strong>{{ $pinjaman->anggota->email ?? '-' }}</strong>
                    </div>

                    <div class="d-flex justify-content-between py-3">
                        <span class="text-muted">Nomor HP</span>
                        <strong>{{ $pinjaman->anggota->no_hp ?? '-' }}</strong>
                    </div>

                </div>
            </div>
        </div>

    </div>


    {{-- Riwayat Angsuran --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white py-3">
            <h5 class="fw-bold mb-0">
                <i class="bi bi-receipt text-primary me-2"></i>
                Riwayat Angsuran
            </h5>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-light">
                        <tr>
                            <th width="60">No.</th>
                            <th>Tanggal Angsuran</th>
                            <th>Jumlah Angsuran</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($pinjaman->angsurans as $angsuran)

                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    {{ $angsuran->tanggal_bayar
                                        ? \Carbon\Carbon::parse($angsuran->tanggal_bayar)->format('d-m-Y')
                                        : '-' }}
                                </td>

                                <td class="fw-semibold">
                                    Rp {{ number_format($angsuran->jumlah_bayar ?? 0, 0, ',', '.') }}
                                </td>

                                <td>
                                    @if (($angsuran->status ?? '') === 'lunas')
                                        <span class="badge bg-success">Lunas</span>
                                    @else
                                        <span class="badge bg-warning text-dark">
                                            {{ ucfirst($angsuran->status ?? 'Belum Dibayar') }}
                                        </span>
                                    @endif
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="4" class="text-center py-5">
                                    <i class="bi bi-inbox fs-1 text-muted"></i>
                                    <p class="text-muted mt-2 mb-0">
                                        Belum ada riwayat angsuran.
                                    </p>
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection
