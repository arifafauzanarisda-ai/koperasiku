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
            background: white;
            padding: 25px;
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
            border-radius: 5px;
            text-decoration: none;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-tambah { background: #2563eb; }
        .btn-detail { background: #0891b2; }
        .btn-edit { background: #d97706; }
        .btn-hapus { background: #dc2626; }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
        }

        th {
            background: #f3f4f6;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .aksi {
            display: flex;
            gap: 5px;
            align-items: center;
        }

        .aksi form {
            margin: 0;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Data Anggota</h1>

    <a href="{{ route('anggota.create') }}" class="btn btn-tambah">
        + Tambah Anggota
    </a>

    @if (session('success'))
        <div class="success" style="margin-top: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Anggota</th>
                <th>NIS/NIM</th>
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
                    <td>{{ $anggota->nis_nim }}</td>
                    <td>{{ $anggota->no_hp ?? '-' }}</td>
                    <td>{{ $anggota->alamat ?? '-' }}</td>
                    <td>
                        <div class="aksi">
                            <a href="{{ route('anggota.show', $anggota) }}"
                               class="btn btn-detail">Detail</a>

                            <a href="{{ route('anggota.edit', $anggota) }}"
                               class="btn btn-edit">Edit</a>

                            <form action="{{ route('anggota.destroy', $anggota) }}"
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