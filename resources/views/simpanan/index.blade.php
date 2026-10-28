
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Simpanan</title>

    <style>
        * { box-sizing: border-box; }

        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px #00000010;
        }

        h1 { color: #1f2937; margin-top: 0; }

        .btn {
            display: inline-block;
            padding: 9px 12px;
            border: none;
            border-radius: 5px;
            color: white;
            text-decoration: none;
            cursor: pointer;
            font-size: 13px;
        }

        .btn-tambah, .btn-search { background: #2563eb; }
        .btn-detail { background: #0891b2; }
        .btn-edit { background: #d97706; }
        .btn-hapus { background: #dc2626; }
        .btn-reset { background: #6b7280; }

        .search-form {
            display: flex;
            gap: 8px;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .search-form input {
            flex: 1;
            min-width: 220px;
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 5px;
        }

        .table-wrapper { overflow-x: auto; }

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

        th { background: #f3f4f6; }

        .aksi {
            display: flex;
            gap: 5px;
            align-items: center;
        }

        .aksi form { margin: 0; }

        .success, .error {
            padding: 12px;
            border-radius: 5px;
            margin-top: 15px;
        }

        .success { background: #dcfce7; color: #166534; }
        .error { background: #fee2e2; color: #991b1b; }

        @media (max-width: 600px) {
            body { padding: 10px; }
            .container { padding: 15px; }
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Data Simpanan</h1>

    <a href="{{ route('simpanan.create') }}" class="btn btn-tambah">
        + Tambah Simpanan
    </a>

    <form action="{{ route('simpanan.index') }}" method="GET" class="search-form">
        <input
            type="text"
            name="keyword"
            placeholder="Cari nomor transaksi, nama anggota, atau jenis simpanan..."
            value="{{ $keyword ?? request('keyword') }}"
        >
        <button type="submit" class="btn btn-search">Cari</button>
        <a href="{{ route('simpanan.index') }}" class="btn btn-reset">Reset</a>
    </form>

    @if (session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>No. Transaksi</th>
                    <th>Nama Anggota</th>
                    <th>Jenis Simpanan</th>
                    <th>Jumlah</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($simpanans as $simpanan)
                    <tr>
                        <td>{{ $simpanans->firstItem() + $loop->index }}</td>
                        <td>{{ $simpanan->no_transaksi }}</td>
                        <td>{{ $simpanan->anggota->nama ?? '-' }}</td>
                        <td>{{ ucfirst($simpanan->jenis_simpanan) }}</td>
                        <td>Rp {{ number_format((float) $simpanan->jumlah, 0, ',', '.') }}</td>
                        <td>{{ $simpanan->tanggal?->format('d-m-Y') ?? '-' }}</td>
                        <td>
                            <div class="aksi">
                                <a href="{{ route('simpanan.show', $simpanan) }}"
                                   class="btn btn-detail">Detail</a>

                                <a href="{{ route('simpanan.edit', $simpanan) }}"
                                   class="btn btn-edit">Edit</a>

                                <form action="{{ route('simpanan.destroy', $simpanan) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus data simpanan ini?')">
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
                        <td colspan="7" style="text-align:center;">
                            Belum ada data simpanan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top:20px;">
        {{ $simpanans->links() }}
    </div>

    <p>
        <a href="{{ route('anggota.index') }}">Kembali ke Data Anggota</a>
    </p>
</div>
</body>
</html>
