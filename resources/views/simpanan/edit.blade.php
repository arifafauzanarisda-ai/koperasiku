<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Simpanan</title>
</head>
<body>
    <h1>HALAMAN EDIT SIMPANAN</h1>

    <p>Jika tulisan ini muncul, file edit.blade.php berhasil ditampilkan.</p>

    @if ($errors->any())
        <div style="color: red;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('simpanan.update', $simpanan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <p>
            <label>Anggota</label><br>
            <select name="anggota_id" required>
                @foreach ($anggotas as $anggota)
                    <option value="{{ $anggota->id }}"
                        @selected(old('anggota_id', $simpanan->anggota_id) == $anggota->id)>
                        {{ $anggota->no_anggota }} - {{ $anggota->nama }}
                    </option>
                @endforeach
            </select>
        </p>

        <p>
            <label>Nomor Transaksi</label><br>
            <input type="text" name="no_transaksi"
                value="{{ old('no_transaksi', $simpanan->no_transaksi) }}"
                maxlength="30" required>
        </p>

        <p>
            <label>Jenis Simpanan</label><br>
            <select name="jenis_simpanan" required>
                <option value="pokok" @selected(old('jenis_simpanan', $simpanan->jenis_simpanan) == 'pokok')>Pokok</option>
                <option value="wajib" @selected(old('jenis_simpanan', $simpanan->jenis_simpanan) == 'wajib')>Wajib</option>
                <option value="sukarela" @selected(old('jenis_simpanan', $simpanan->jenis_simpanan) == 'sukarela')>Sukarela</option>
            </select>
        </p>

        <p>
            <label>Jumlah Simpanan (Rp)</label><br>
            <input type="number" name="jumlah" min="0.01" step="0.01"
                value="{{ old('jumlah', $simpanan->jumlah) }}" required>
        </p>

        <p>
            <label>Tanggal Simpanan</label><br>
            <input type="date" name="tanggal"
                value="{{ old('tanggal', $simpanan->tanggal?->format('Y-m-d')) }}"
                max="{{ now()->format('Y-m-d') }}" required>
        </p>

        <p>
            <label>Keterangan</label><br>
            <textarea name="keterangan" rows="4">{{ old('keterangan', $simpanan->keterangan) }}</textarea>
        </p>

        <button type="submit">Simpan Perubahan</button>
        <a href="{{ route('simpanan.index') }}">Kembali</a>
    </form>
</body>
</html>