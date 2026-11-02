@extends('layouts.app')

@section('title', 'Tambah Simpanan')
@section('page-title', 'Tambah Simpanan')

@section('content')

<div class="member-page">

    <div class="member-heading">
        <div>
            <h3>Tambah Simpanan</h3>
            <p>Masukkan data transaksi simpanan anggota koperasi.</p>
        </div>

        <a href="{{ route('simpanan.index') }}" class="btn-member-cancel">
            ← Kembali
        </a>
    </div>

    <div class="member-card">

        <div class="member-card-header">
            <h5>Formulir Simpanan</h5>
        </div>

        <div class="member-card-body">

            <form action="{{ route('simpanan.store') }}"
                  method="POST"
                  id="formSimpanan">

                @csrf

                @include('simpanan.form')

            </form>

        </div>
    </div>

    <p class="required-note">* Wajib diisi.</p>

</div>

@endsection
