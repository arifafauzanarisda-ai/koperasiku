
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Simpanan</title>
</head>
<body>
    <h1>Halaman Tambah Simpanan</h1>
    <p>Jika tulisan ini muncul, file Blade berhasil ditampilkan.</p>

    <form action="{{ route('simpanan.store') }}" method="POST">
        @csrf

        <label>Anggota</label>
        <select name="anggota_id" required>
            <option value="">-- Pilih Anggota --</option>
            @foreach ($anggotas as $anggota)
                <option value="{{ $anggota->id }}">
                    {{ $anggota->no_anggota }} - {{ $anggota->nama }}
                </option>
            @endforeach
        </select>

        <br><br>

        <label>Nomor Transaksi</label>
        <input type="text" name="no_transaksi" required>

        <br><br>

        <label>Jenis Simpanan</label>
        <select name="jenis_simpanan" required>
            <option value="pokok">Pokok</option>
            <option value="wajib">Wajib</option>
            <option value="sukarela">Sukarela</option>
        </select>

        <br><br>

        <label>Jumlah</label>
        <input type="number" name="jumlah" min="0.01"
               step="0.01" required>

        <br><br>

        <label>Tanggal</label>
        <input type="date" name="tanggal"
               value="{{ now()->format('Y-m-d') }}"
               max="{{ now()->format('Y-m-d') }}" required>

        <br><br>

        <label>Keterangan</label>
        <textarea name="keterangan"></textarea>

        <br><br>

        <button type="submit">Simpan</button>
        <a href="{{ route('simpanan.index') }}">Kembali</a>
    </form>
</body>
</html>
