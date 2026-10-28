
@extends('layouts.app')

@section('title', 'Detail Pinjaman')
@section('page-title', 'Detail Pinjaman')

@section('content')
<div class="panel">
    <h2>Detail Pinjaman #{{ $pinjaman->id }}</h2>

    <table>
        <tbody>
            <tr>
                <th>Nama Anggota</th>
                <td>{{ $pinjaman->anggota->nama ?? 'Anggota tidak ditemukan' }}</td>
            </tr>
            <tr>
                <th>Jumlah Pengajuan</th>
                <td>Rp {{ number_format((float) $pinjaman->jumlah_pengajuan, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Jumlah Disetujui</th>
                <td>Rp {{ number_format((float) $pinjaman->jumlah_disetujui, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Bunga</th>
                <td>{{ $pinjaman->bunga_persen }}%</td>
            </tr>
            <tr>
                <th>Tenor</th>
                <td>{{ $pinjaman->tenor_bulan }} bulan</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ ucfirst($pinjaman->status) }}</td>
            </tr>
        </tbody>
    </table>

    <div style="display:flex;gap:10px;margin-top:20px;flex-wrap:wrap;">
        <a href="{{ route('pinjaman.edit', $pinjaman->id) }}"
           class="button">
            Edit Pinjaman
        </a>

        <a href="{{ route('pinjaman.index') }}"
           class="button button-secondary">
            Kembali
        </a>
    </div>
</div>
@endsection
