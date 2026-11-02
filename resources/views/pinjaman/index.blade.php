
@extends('layouts.app')

@section('title', 'Data Pinjaman')
@section('page-title', 'Data Pinjaman')

@section('content')

<div class="container-fluid">

    {{-- Notifikasi --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="bi bi-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Header dan tombol tambah --}}
    <div class="card card-primary card-outline mb-4">

        <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h3 class="card-title mb-1">
                    <i class="bi bi-cash-stack me-2"></i>
                    Daftar Pinjaman
                </h3>
                <div class="text-muted small">
                    Kelola pengajuan, persetujuan, pencairan, dan pelunasan pinjaman.
                </div>
            </div>

            <a href="{{ route('pinjaman.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i>
                Tambah Pinjaman
            </a>
        </div>

        <div class="card-body">

            {{-- Pencarian --}}
            <form action="{{ route('pinjaman.index') }}"
                  method="GET"
                  class="row g-2 mb-4">

                <div class="col-md-5">
                    <input
                        type="text"
                        name="keyword"
                        class="form-control"
                        value="{{ $keyword ?? '' }}"
                        placeholder="Cari nama anggota atau status..."
                    >
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search me-1"></i>
                        Cari
                    </button>
                </div>

                <div class="col-md-2">
                    <a href="{{ route('pinjaman.index') }}"
                       class="btn btn-secondary w-100">
                        <i class="bi bi-arrow-counterclockwise me-1"></i>
                        Reset
                    </a>
                </div>

            </form>

            {{-- Tabel Pinjaman --}}
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-primary">
                        <tr>
                            <th class="text-center">No.</th>
                            <th>Anggota</th>
                            <th>Jumlah Pengajuan</th>
                            <th>Jumlah Disetujui</th>
                            <th>Jumlah Pencairan</th>
                            <th>Bunga</th>
                            <th>Tenor</th>
                            <th>Status</th>
                            <th style="min-width: 280px;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($pinjamans as $pinjaman)

                            <tr>
                                <td class="text-center">
                                    {{ $pinjamans->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    <strong>
                                        {{ $pinjaman->anggota->nama ?? 'Anggota tidak ditemukan' }}
                                    </strong>
                                </td>

                                <td>
                                    Rp {{ number_format((float) $pinjaman->jumlah_pengajuan, 0, ',', '.') }}
                                </td>

                                <td>
                                    Rp {{ number_format((float) $pinjaman->jumlah_disetujui, 0, ',', '.') }}
                                </td>

                                <td>
                                    Rp {{ number_format((float) $pinjaman->jumlah_pencairan, 0, ',', '.') }}
                                </td>

                                <td>{{ $pinjaman->bunga_persen }}%</td>

                                <td>{{ $pinjaman->tenor_bulan }} bulan</td>

                                {{-- Status --}}
                                <td>
                                    @if ($pinjaman->status === 'diajukan')
                                        <span class="badge bg-warning text-dark">
                                            Diajukan
                                        </span>
                                    @elseif ($pinjaman->status === 'disetujui')
                                        <span class="badge bg-info">
                                            Disetujui
                                        </span>
                                    @elseif ($pinjaman->status === 'ditolak')
                                        <span class="badge bg-danger">
                                            Ditolak
                                        </span>
                                    @elseif ($pinjaman->status === 'dicairkan')
                                        <span class="badge bg-primary">
                                            Dicairkan
                                        </span>
                                    @elseif ($pinjaman->status === 'lunas')
                                        <span class="badge bg-success">
                                            Lunas
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            {{ ucfirst($pinjaman->status) }}
                                        </span>
                                    @endif
                                </td>

                                {{-- Tombol Aksi --}}
                                <td>
                                    <div class="d-flex flex-wrap gap-1">

                                        {{-- Detail --}}
                                        <a href="{{ route('pinjaman.show', $pinjaman) }}"
                                           class="btn btn-sm btn-info"
                                           title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        {{-- Edit hanya jika diajukan --}}
                                        @if ($pinjaman->status === 'diajukan')
                                            <a href="{{ route('pinjaman.edit', $pinjaman) }}"
                                               class="btn btn-sm btn-warning"
                                               title="Edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                        @endif

                                        {{-- Proses khusus Admin --}}
                                        @if (auth()->user()->role === 'admin')

                                            {{-- Setujui --}}
                                            @if ($pinjaman->status === 'diajukan')

                                                <form action="{{ route('pinjaman.setujui', $pinjaman->id) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Setujui pengajuan pinjaman ini?')">
                                                    @csrf

                                                    <input
                                                        type="hidden"
                                                        name="jumlah_disetujui"
                                                        value="{{ $pinjaman->jumlah_pengajuan }}"
                                                    >

                                                    <button type="submit"
                                                            class="btn btn-sm btn-success"
                                                            title="Setujui">
                                                        <i class="bi bi-check-circle"></i>
                                                        Setujui
                                                    </button>
                                                </form>

                                                {{-- Tolak --}}
                                                <form action="{{ route('pinjaman.tolak', $pinjaman->id) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Yakin ingin menolak pinjaman ini?')">
                                                    @csrf

                                                    <button type="submit"
                                                            class="btn btn-sm btn-danger"
                                                            title="Tolak">
                                                        <i class="bi bi-x-circle"></i>
                                                        Tolak
                                                    </button>
                                                </form>

                                            @endif

                                            {{-- Cairkan --}}
                                            @if ($pinjaman->status === 'disetujui')

                                                <form action="{{ route('pinjaman.cairkan', $pinjaman->id) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Catat pencairan pinjaman ini?')">
                                                    @csrf

                                                    <input
                                                        type="hidden"
                                                        name="jumlah_pencairan"
                                                        value="{{ $pinjaman->jumlah_disetujui }}"
                                                    >

                                                    <button type="submit"
                                                            class="btn btn-sm btn-primary">
                                                        <i class="bi bi-wallet2"></i>
                                                        Cairkan
                                                    </button>
                                                </form>

                                            @endif

                                            {{-- Lunasi --}}
                                            @if ($pinjaman->status === 'dicairkan')

                                                <form action="{{ route('pinjaman.lunasi', $pinjaman->id) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Ubah status pinjaman menjadi lunas?')">
                                                    @csrf

                                                    <button type="submit"
                                                            class="btn btn-sm btn-success">
                                                        <i class="bi bi-check2-all"></i>
                                                        Lunasi
                                                    </button>
                                                </form>

                                            @endif

                                        @endif

                                        {{-- Hapus hanya untuk status tertentu --}}
                                        @if (in_array($pinjaman->status, ['diajukan', 'ditolak'], true))

                                            <form action="{{ route('pinjaman.destroy', $pinjaman) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus pinjaman ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="btn btn-sm btn-danger"
                                                        title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>

                                        @endif

                                    </div>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="9" class="text-center py-4">
                                    <i class="bi bi-inbox fs-2 text-muted"></i>
                                    <p class="text-muted mb-0 mt-2">
                                        Belum ada data pinjaman.
                                    </p>
                                </td>
                            </tr>

                        @endforelse

                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-between align-items-center flex-wrap mt-3">
                <small class="text-muted">
                    Menampilkan {{ $pinjamans->firstItem() ?? 0 }}
                    sampai {{ $pinjamans->lastItem() ?? 0 }}
                    dari {{ $pinjamans->total() }} data
                </small>

                {{ $pinjamans->links() }}
            </div>

        </div>
    </div>
</div>

@endsection
