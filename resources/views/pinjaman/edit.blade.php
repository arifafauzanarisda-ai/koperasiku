
@extends('layouts.app')

@section('title', 'Edit Pinjaman')
@section('page-title', 'Edit Pinjaman')

@section('content')
<div class="panel">
    <h2>Form Edit Pinjaman</h2>
    <p style="color:#64748b;">
        Perbarui data pinjaman sesuai kondisi yang sebenarnya.
    </p>

    {{-- Menampilkan pesan kesalahan validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Periksa kembali data berikut:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form edit pinjaman --}}
    <form
        action="{{ route('pinjaman.update', ['pinjaman' => $pinjaman->id]) }}"
        method="POST"
    >
        @csrf
        @method('PUT')

        {{-- Nama Anggota --}}
        <div style="margin-bottom:18px;">
            <label for="anggota_id">Nama Anggota</label><br><br>

            <select
                id="anggota_id"
                name="anggota_id"
                required
                style="width:100%;"
            >
                <option value="">-- Pilih Anggota --</option>

                @foreach ($anggotas as $anggota)
                    <option
                        value="{{ $anggota->id }}"
                        {{ old('anggota_id', $pinjaman->anggota_id) == $anggota->id ? 'selected' : '' }}
                    >
                        {{ $anggota->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Jumlah Pengajuan --}}
        <div style="margin-bottom:18px;">
            <label for="jumlah_pengajuan">
                Jumlah Pengajuan (Rp)
            </label><br><br>

            <input
                type="number"
                id="jumlah_pengajuan"
                name="jumlah_pengajuan"
                value="{{ old('jumlah_pengajuan', $pinjaman->jumlah_pengajuan) }}"
                min="1"
                step="1"
                required
                style="width:100%;"
            >
        </div>

        {{-- Jumlah Disetujui --}}
        <div style="margin-bottom:18px;">
            <label for="jumlah_disetujui">
                Jumlah Disetujui (Rp)
            </label><br><br>

            <input
                type="number"
                id="jumlah_disetujui"
                name="jumlah_disetujui"
                value="{{ old('jumlah_disetujui', $pinjaman->jumlah_disetujui ?? 0) }}"
                min="0"
                step="1"
                required
                style="width:100%;"
            >
        </div>

        {{-- Bunga --}}
        <div style="margin-bottom:18px;">
            <label for="bunga_persen">Bunga (%)</label><br><br>

            <input
                type="number"
                id="bunga_persen"
                name="bunga_persen"
                value="{{ old('bunga_persen', $pinjaman->bunga_persen) }}"
                min="0"
                max="100"
                step="0.01"
                required
                style="width:100%;"
            >
        </div>

        {{-- Tenor --}}
        <div style="margin-bottom:18px;">
            <label for="tenor_bulan">Tenor (bulan)</label><br><br>

            <input
                type="number"
                id="tenor_bulan"
                name="tenor_bulan"
                value="{{ old('tenor_bulan', $pinjaman->tenor_bulan) }}"
                min="1"
                max="600"
                step="1"
                required
                style="width:100%;"
            >
        </div>

        {{-- Status Pinjaman --}}
        <div style="margin-bottom:24px;">
            <label for="status">Status Pinjaman</label><br><br>

            <select
                id="status"
                name="status"
                required
                style="width:100%;"
            >
                @foreach ([
                    'diajukan' => 'Diajukan',
                    'disetujui' => 'Disetujui',
                    'ditolak' => 'Ditolak',
                    'berjalan' => 'Berjalan',
                    'lunas' => 'Lunas'
                ] as $value => $label)
                    <option
                        value="{{ $value }}"
                        {{ old('status', $pinjaman->status) == $value ? 'selected' : '' }}
                    >
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Tombol Aksi --}}
        <div style="display:flex;gap:10px;flex-wrap:wrap;">
            <button type="submit" class="button">
                Simpan Perubahan
            </button>

            <a
                href="{{ route('pinjaman.show', ['pinjaman' => $pinjaman->id]) }}"
                class="button button-secondary"
            >
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
