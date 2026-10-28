
@extends('layouts.app')

@section('title', 'Tambah Pinjaman')
@section('page-title', 'Tambah Pinjaman')

@section('content')
<div class="panel">
    <h2>Form Tambah Pinjaman</h2>
    <p>Silakan isi data pengajuan pinjaman anggota.</p>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pinjaman.store') }}" method="POST">
        @csrf

        <div style="margin-bottom:18px;">
            <label for="anggota_id">Nama Anggota</label><br><br>
            <select id="anggota_id" name="anggota_id"
                    required style="width:100%;">
                <option value="">-- Pilih Anggota --</option>
                @foreach ($anggotas as $anggota)
                    <option value="{{ $anggota->id }}"
                        {{ old('anggota_id') == $anggota->id ? 'selected' : '' }}>
                        {{ $anggota->nama }}
                    </option>
                @endforeach
            </select>

            @if ($anggotas->isEmpty())
                <p style="color:red;">
                    Data anggota belum tersedia. Tambahkan anggota terlebih dahulu.
                </p>
            @endif
        </div>

        <div style="margin-bottom:18px;">
            <label for="jumlah_pengajuan">Jumlah Pengajuan (Rp)</label><br><br>
            <input type="number" id="jumlah_pengajuan"
                   name="jumlah_pengajuan"
                   value="{{ old('jumlah_pengajuan') }}"
                   min="1" step="1" required
                   style="width:100%;"
                   placeholder="Contoh: 5000000">
        </div>

        <div style="margin-bottom:18px;">
            <label for="bunga_persen">Bunga (%)</label><br><br>
            <input type="number" id="bunga_persen"
                   name="bunga_persen"
                   value="{{ old('bunga_persen', 0) }}"
                   min="0" max="100" step="0.01"
                   required style="width:100%;">
        </div>

        <div style="margin-bottom:18px;">
            <label for="tenor_bulan">Tenor (bulan)</label><br><br>
            <input type="number" id="tenor_bulan"
                   name="tenor_bulan"
                   value="{{ old('tenor_bulan', 1) }}"
                   min="1" max="600" required
                   style="width:100%;">
        </div>

        <div style="margin-bottom:24px;">
            <label for="status">Status Pengajuan</label><br><br>
            <select id="status" name="status" required
                    style="width:100%;">
                <option value="diajukan">Diajukan</option>
            </select>
        </div>

        <button type="submit" class="button"
            {{ $anggotas->isEmpty() ? 'disabled' : '' }}>
            Simpan Pinjaman
        </button>

        <a href="{{ route('pinjaman.index') }}"
           class="button button-secondary">
            Kembali
        </a>
    </form>
</div>
@endsection
