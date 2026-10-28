<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Anggota</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            padding: 25px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px #00000010;
        }

        h1 {
            color: #1f2937;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 9px 14px;
            border: none;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-tambah,
        .btn-search {
            background: #2563eb;
        }

        .btn-detail {
            background: #0891b2;
        }

        .btn-edit {
            background: #d97706;
        }

        .btn-hapus {
            background: #dc2626;
        }

        .btn-reset {
            background: #6b7280;
        }

        .search-form {
            display: flex;
            gap: 8px;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .search-form input {
            flex: 1;
            min-width: 200px;
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 5px;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
        }

        th {
            background: #f3f4f6;
        }

        .aksi {
            display: flex;
            gap: 5px;
            align-items: center;
            flex-wrap: wrap;
        }

        .aksi form {
            margin: 0;
        }

        .success,
        .error {
            padding: 12px;
            border-radius: 5px;
            margin-top: 15px;
        }

        .success {
            background: #dcfce7;
            color: #166534;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
        }

        @media (max-width: 768px) {
            body {
                padding: 12px;
            }

            .container {
                padding: 15px;
                overflow-x: auto;
            }
        }
    </style>
</head>

<body>
<div class="container">

    <h1>Data Anggota</h1>

    <a href="{{ route('anggota.create') }}" class="btn btn-tambah">
        + Tambah Anggota
    </a>

    {{-- Form pencarian --}}
    <form action="{{ route('anggota.index') }}"
          method="GET"
          class="search-form">

        <input
            type="text"
            name="keyword"
            placeholder="Cari nama, nomor anggota, NIK, atau nomor HP..."
            value="{{ $keyword ?? request('keyword') }}"
        >

        <button type="submit" class="btn btn-search">
            Cari
        </button>

        <a href="{{ route('anggota.index') }}" class="btn btn-reset">
            Reset
        </a>
    </form>

    {{-- Pesan berhasil --}}
    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Pesan gagal --}}
    @if (session('error'))
        <div class="error">
            {{ session('error') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Anggota</th>
                <th>NIK</th>
                <th>No. HP</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($anggotas as $anggota)
                <tr>
                    <td>{{ $anggotas->firstItem() + $loop->index }}</td>
                    <td>{{ $anggota->nama }}</td>
                    <td>{{ $anggota->nik ?? '-' }}</td>
                    <td>{{ $anggota->no_hp ?? '-' }}</td>
                    <td>{{ $anggota->alamat ?? '-' }}</td>

                    <td>
                        <div class="aksi">

                            <a href="{{ route('anggota.show', $anggota) }}"
                               class="btn btn-detail">
                                Detail
                            </a>

                            <a href="{{ route('anggota.edit', $anggota) }}"
                               class="btn btn-edit">
                                Edit
                            </a>

                            <form
                                action="{{ route('anggota.destroy', $anggota->id) }}"
                                method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus anggota ini?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-hapus">
                                    Hapus
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">
                        Belum ada data anggota.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 20px;">
        {{ $anggotas->links() }}
    </div>

</div>
</body>
</html>
