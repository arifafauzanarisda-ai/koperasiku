
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Data Pinjaman</h1>

    @if (session('success'))
        <div style="padding:10px;background:#d1fae5;margin-bottom:12px;">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div style="padding:10px;background:#fee2e2;margin-bottom:12px;">
            {{ session('error') }}
        </div>
    @endif

    <a href="{{ route('pinjaman.create') }}">+ Tambah Pinjaman</a>

    <form action="{{ route('pinjaman.index') }}" method="GET"
          style="margin:15px 0;">
        <input type="text" name="keyword"
               value="{{ $keyword ?? '' }}"
               placeholder="Cari nama anggota atau status">
        <button type="submit">Cari</button>
        <a href="{{ route('pinjaman.index') }}">Reset</a>
    </form>

    @if ($pinjamans->isEmpty())
        <p>Belum ada data pinjaman.</p>
    @else
        <table border="1" cellpadding="8" cellspacing="0"
               style="width:100%;border-collapse:collapse;">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Anggota</th>
                    <th>Jumlah Pengajuan</th>
                    <th>Jumlah Disetujui</th>
                    <th>Bunga (%)</th>
                    <th>Tenor (bulan)</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pinjamans as $pinjaman)
                    <tr>
                        <td>{{ $pinjamans->firstItem() + $loop->index }}</td>
                        <td>
                            {{ $pinjaman->anggota->nama ?? 'Anggota tidak ditemukan' }}
                        </td>
                        <td>Rp {{ number_format((float) $pinjaman->jumlah_pengajuan, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format((float) $pinjaman->jumlah_disetujui, 0, ',', '.') }}</td>
                        <td>{{ $pinjaman->bunga_persen }}</td>
                        <td>{{ $pinjaman->tenor_bulan }}</td>
                        <td>{{ ucfirst($pinjaman->status) }}</td>
                        <td>
                            <a href="{{ route('pinjaman.show', $pinjaman) }}">Detail</a>
                            |
                            <a href="{{ route('pinjaman.edit', $pinjaman) }}">Edit</a>
                            |
                            <form action="{{ route('pinjaman.destroy', $pinjaman) }}"
                                  method="POST" style="display:inline;"
                                  onsubmit="return confirm('Yakin ingin menghapus pinjaman ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top:15px;">
            {{ $pinjamans->links() }}
        </div>
    @endif
</div>
@endsection
