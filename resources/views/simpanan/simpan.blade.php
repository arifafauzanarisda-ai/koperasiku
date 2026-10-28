<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Simpanan</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            padding: 30px;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            padding: 25px;
            background: white;
            border-radius: 10px;
        }

        h1 {
            color: #1f2937;
        }

        .btn {
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            cursor: pointer;
        }

        .tambah { background: #2563eb; }
        .detail { background: #0891b2; }
        .edit { background: #d97706; }
        .hapus { background: #dc2626; }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #f3f4f6;
        }

        .success {
            margin-top: 15px;
            padding: 12px;
            background: #dcfce7;
            color: #166534;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Data Simpanan</h1>

    <a href="{{ route('simpan.create') }}" class="btn tambah">
        + Tambah Simpanan
    </a>

    @if (session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Anggota</th>
                <th>Jenis Simpanan</th>
                <th>Nominal</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($simpans as $simpan)
                <tr>
                    <td>{{ $simpans->firstItem() + $loop->index }}</td>
                    <td>{{ $simpan->anggota->nama ?? '-' }}</td>
                    <td>{{ ucfirst($simpan->jenis) }}</td>
                    <td>Rp {{ number_format($simpan->nominal, 0, ',', '.') }}</td>
                    <td>{{ $simpan->tanggal_transaksi }}</td>
                    <td>{{ ucfirst($simpan->status) }}</td>
                    <td>
                        <a href="{{ route('simpan.show', $simpan) }}"
                           class="btn detail">Detail</a>

                        <a href="{{ route('simpan.edit', $simpan) }}"
                           class="btn edit">Edit</a>

                        <form action="{{ route('simpan.destroy', $simpan) }}"
                              method="POST"
                              style="display:inline"
                              onsubmit="return confirm('Hapus data simpanan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn hapus">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center">
                        Belum ada data simpanan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top:20px">
        {{ $simpans->links() }}
    </div>
</div>
</body>
</html>