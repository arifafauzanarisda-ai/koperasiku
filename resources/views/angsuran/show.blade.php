
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Detail Angsuran</h2>
        <a href="{{ route('angsuran.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            Informasi Angsuran #{{ $angsuran->id }}
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th width="35%">ID Angsuran</th>
                    <td>{{ $angsuran->id }}</td>
                </tr>
                <tr>
                    <th>ID Pinjaman</th>
                    <td>{{ $angsuran->pinjaman_id }}</td>
                </tr>
                <tr>
                    <th>Nama Anggota</th>
                    <td>
                        {{ $angsuran->pinjaman?->anggota?->nama ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <th>Angsuran Ke</th>
                    <td>{{ $angsuran->angsuran_ke }}</td>
                </tr>
                <tr>
                    <th>Jumlah Angsuran</th>
                    <td>
                        Rp {{ number_format((float) $angsuran->jumlah_angsuran, 0, ',', '.') }}
                    </td>
                </tr>
                <tr>
                    <th>Denda</th>
                    <td>
                        Rp {{ number_format((float) ($angsuran->denda ?? 0), 0, ',', '.') }}
                    </td>
                </tr>
                <tr>
                    <th>Tanggal Jatuh Tempo</th>
                    <td>
                        {{ $angsuran->tanggal_jatuh_tempo?->format('d-m-Y') ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <th>Tanggal Bayar</th>
                    <td>
                        {{ $angsuran->tanggal_bayar?->format('d-m-Y') ?? '-' }}
                    </td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        @if ($angsuran->status === 'lunas')
                            <span class="badge bg-success">Lunas</span>
                        @else
                            <span class="badge bg-warning text-dark">
                                Belum Bayar
                            </span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Dibuat Pada</th>
                    <td>{{ $angsuran->created_at?->format('d-m-Y H:i') ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Diperbarui Pada</th>
                    <td>{{ $angsuran->updated_at?->format('d-m-Y H:i') ?? '-' }}</td>
                </tr>
            </table>

            <a href="{{ route('angsuran.edit', $angsuran->id) }}"
               class="btn btn-warning">
                Edit Angsuran
            </a>
        </div>
    </div>
</div>
@endsection
