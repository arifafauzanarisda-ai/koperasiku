@extends('layouts.app')

@section('title', 'Tambah Anggota')

@section('content')
<div class="container py-4">

    {{-- Header halaman --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-1">Tambah Anggota</h3>
            <p class="text-muted mb-0">
                Masukkan data anggota koperasi baru.
            </p>
        </div>

        <a href="{{ route('anggota.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </div>

    {{-- Pesan berhasil --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}

            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
                aria-label="Tutup">
            </button>
        </div>
    @endif

    {{-- Pesan kesalahan validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <strong>Data belum berhasil disimpan.</strong>
            <p class="mb-1">Periksa kembali bagian berikut:</p>

            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Formulir tambah anggota --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white py-3">
            <h5 class="mb-0">Formulir Anggota</h5>
        </div>

        <div class="card-body p-4">

            <form
                action="{{ route('anggota.store') }}"
                method="POST"
                id="formAnggota">

                @csrf

                {{-- Input anggota --}}
                @include('anggota.form')

            </form>

        </div>
    </div>

    <p class="text-muted small mt-3">
        <span class="text-danger">*</span>
        Wajib diisi.
    </p>

</div>
@endsection