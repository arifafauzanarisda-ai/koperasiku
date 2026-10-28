
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Anggota</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 850px;
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

        .form-group {
            margin-bottom: 16px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 7px;
            color: #374151;
        }

        input, select, textarea {
            width: 100%;
            box-sizing: border-box;
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 5px;
            font-size: 14px;
        }

        textarea {
            min-height: 90px;
            resize: vertical;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            margin-top: 5px;
        }

        .alert {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .aksi {
            display: flex;
            gap: 8px;
            margin-top: 22px;
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-simpan { background: #2563eb; }
        .btn-kembali { background: #6b7280; }
    </style>
</head>
<body>
<div class="container">
    <h1>Edit Data Anggota</h1>

    @if ($errors->any())
        <div class="alert">
            <strong>Periksa kembali data yang dimasukkan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('anggota.update', $anggota->id) }}"
          method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="no_anggota">Nomor Anggota</label>
            <input type="text" id="no_anggota" name="no_anggota"
                   value="{{ old('no_anggota', $anggota->no_anggota) }}"
                   maxlength="30" required>
            @error('no_anggota')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="nik">NIK (16 digit)</label>
            <input type="text" id="nik" name="nik"
                   value="{{ old('nik', $anggota->nik) }}"
                   inputmode="numeric" maxlength="16"
                   pattern="[0-9]{16}" required>
            @error('nik')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input type="text" id="nama" name="nama"
                   value="{{ old('nama', $anggota->nama) }}"
                   maxlength="150" required>
            @error('nama')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="L"
                    {{ old('jenis_kelamin', $anggota->jenis_kelamin) === 'L' ? 'selected' : '' }}>
                    Laki-laki
                </option>
                <option value="P"
                    {{ old('jenis_kelamin', $anggota->jenis_kelamin) === 'P' ? 'selected' : '' }}>
                    Perempuan
                </option>
            </select>
            @error('jenis_kelamin')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="tempat_lahir">Tempat Lahir</label>
            <input type="text" id="tempat_lahir" name="tempat_lahir"
                   value="{{ old('tempat_lahir', $anggota->tempat_lahir) }}"
                   maxlength="100">
            @error('tempat_lahir')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <input type="date" id="tanggal_lahir" name="tanggal_lahir"
                   value="{{ old('tanggal_lahir', $anggota->tanggal_lahir?->format('Y-m-d')) }}"
                   max="{{ date('Y-m-d') }}">
            @error('tanggal_lahir')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea id="alamat" name="alamat" required>{{ old('alamat', $anggota->alamat) }}</textarea>
            @error('alamat')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="no_hp">Nomor HP</label>
            <input type="text" id="no_hp" name="no_hp"
                   value="{{ old('no_hp', $anggota->no_hp) }}"
                   maxlength="20" required>
            @error('no_hp')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email (opsional)</label>
            <input type="email" id="email" name="email"
                   value="{{ old('email', $anggota->email) }}"
                   maxlength="255">
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="tanggal_bergabung">Tanggal Bergabung</label>
            <input type="date" id="tanggal_bergabung"
                   name="tanggal_bergabung"
                   value="{{ old('tanggal_bergabung', $anggota->tanggal_bergabung?->format('Y-m-d') ?? $anggota->tanggal_gabung?->format('Y-m-d')) }}"
                   max="{{ date('Y-m-d') }}" required>
            @error('tanggal_bergabung')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="status">Status Anggota</label>
            <select id="status" name="status" required>
                <option value="aktif"
                    {{ old('status', $anggota->status) === 'aktif' ? 'selected' : '' }}>
                    Aktif
                </option>
                <option value="nonaktif"
                    {{ old('status', $anggota->status) === 'nonaktif' ? 'selected' : '' }}>
                    Nonaktif
                </option>
            </select>
            @error('status')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="aksi">
            <button type="submit" class="btn btn-simpan">
                Simpan Perubahan
            </button>

            <a href="{{ route('anggota.index') }}"
               class="btn btn-kembali">
                Kembali
            </a>
        </div>
    </form>
</div>
</body>
</html>
