
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Angsuran</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; color: #222; }
        h1 { margin-bottom: 20px; }
        a, button { padding: 8px 12px; cursor: pointer; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background: #eee; }
        .success { color: green; }
        .error { color: red; }
    </style>
</head>
<body>
    <h1>Data Angsuran</h1>

    @if (session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <div class="error">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <p>
        <a href="{{ route('angsuran.create') }}">+ Tambah Angsuran</a>
        <a href="{{ route('simpanan.index') }}">Kembali ke Simpanan</a>
    </p>

    <form action="{{ route('angsuran.index') }}" method="GET">
        <input type="text" name="keyword"
               value="{{ $keyword ?? '' }}"
               placeholder="Cari angsuran...">
        <button type="submit">Cari</button>
        <a href="{{ route('angsuran.index') }}">Reset</a>
    </form>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>ID Pinjaman</th>
                <th>Angsuran Ke</th>
                <th>Jumlah</th>
                <th>Denda</th>
                <th>Jatuh Tempo</th>
                <th>Tanggal Bayar</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($angsurans as $angsuran)
                <tr>
                    <td>{{ $angsurans->firstItem() + $loop->index }}</td>
                    <td>{{ $angsuran->pinjaman_id }}</td>
                    <td>{{ $angsuran->angsuran_ke }}</td>
                    <td>Rp {{ number_format((float) $angsuran->jumlah_angsuran, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format((float) ($angsuran->denda ?? 0), 0, ',', '.') }}</td>
                    <td>{{ $angsuran->tanggal_jatuh_tempo?->format('d-m-Y') ?? '-' }}</td>
                    <td>{{ $angsuran->tanggal_bayar?->format('d-m-Y') ?? '-' }}</td>
                    <td>{{ $angsuran->status }}</td>
                    <td>
                        <a href="{{ route('angsuran.show', $angsuran->id) }}">Detail</a>
                        <a href="{{ route('angsuran.edit', $angsuran->id) }}">Edit</a>
                        <form action="{{ route('angsuran.destroy', $angsuran->id) }}"
                              method="POST"
                              style="display:inline"
                              onsubmit="return confirm('Hapus angsuran ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">Belum ada data angsuran.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $angsurans->links() }}
</body>
</html>
