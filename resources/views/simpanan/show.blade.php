
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2>Detail Simpanan</h2>
            <p class="text-muted mb-0">
                Informasi lengkap transaksi simpanan.
            </p>
        </div>

        <a href="{{ route('simpanan.index') }}"
           class="btn btn-secondary">
            Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            Informasi Simpanan
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th width="30%">Nomor Transaksi</th>
                    <td>{{ $simpanan->no_transaksi }}</td>
                </tr>

                <tr>
                    <th>Nomor Anggota</th>
                    <td>{{ $simpanan->anggota->no_anggota ?? '-' }}</td>
                </tr>

                <tr>
                    <th>Nama Anggota</th>
                    <td>{{ $simpanan->anggota->nama ?? '-' }}</td>
                </tr>

                <tr>
                    <th>Jenis Simpanan</th>
                    <td>{{ ucfirst($simpanan->jenis_simpanan) }}</td>
                </tr>

                <tr>
                    <th>Jumlah</th>
                    <td>
                        Rp {{ number_format((float) $simpanan->jumlah, 0, ',', '.') }}
                    </td>
                </tr>

                <tr>
                    <th>Tanggal</th>
                    <td>
                        {{ $simpanan->tanggal?->format('d-m-Y') ?? '-' }}
                    </td>
                </tr>

                <tr>
                    <th>Keterangan</th>
                    <td>{{ $simpanan->keterangan ?: '-' }}</td>
                </tr>

                <tr>
                    <th>Dibuat</th>
                    <td>
                        {{ $simpanan->created_at?->format('d-m-Y H:i') ?? '-' }}
                    </td>
                </tr>

                <tr>
                    <th>Terakhir Diperbarui</th>
                    <td>
                        {{ $simpanan->updated_at?->format('d-m-Y H:i') ?? '-' }}
                    </td>
                </tr>
            </table>

            <a href="{{ route('simpanan.edit', $simpanan) }}"
               class="btn btn-warning">
                Edit Simpanan
            </a>

            <a href="{{ route('simpanan.index') }}"
               class="btn btn-secondary">
                Kembali ke Daftar
            </a>
        </div>
    </div>
</div>
@endsection
