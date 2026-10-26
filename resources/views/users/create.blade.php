```blade
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User - KoperasiKu</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            margin: 0;
            padding: 30px;
            color: #1f2937;
        }

        .container {
            max-width: 650px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 3px 12px #0000000a;
        }

        h1 { margin-top: 0; }

        label {
            display: block;
            margin: 16px 0 7px;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 11px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 15px;
        }

        .btn {
            display: inline-block;
            padding: 11px 16px;
            border: none;
            border-radius: 6px;
            color: white;
            text-decoration: none;
            cursor: pointer;
            margin-top: 22px;
            font-size: 14px;
        }

        .save { background: #2563eb; }
        .back { background: #64748b; }

        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px;
            border-radius: 6px;
        }
    </style>
</head>

<body>
<div class="container">
    <h1>Tambah User</h1>
    <p>Masukkan data pengguna baru KoperasiKu.</p>

    @if ($errors->any())
        <div class="error">
            <strong>Periksa kembali data berikut:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <label for="name">Nama Lengkap</label>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name') }}"
            required
        >

        <label for="email">Email</label>
        <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email') }}"
            required
        >

        <label for="password">Password</label>
        <input
            type="password"
            id="password"
            name="password"
            minlength="8"
            required
        >
        <small>Password minimal 8 karakter.</small>

        <label for="role">Role Pengguna</label>
        <select id="role" name="role" required>
            <option value="">-- Pilih Role --</option>
            <option value="admin" @selected(old('role') == 'admin')>Admin</option>
            <option value="pengurus" @selected(old('role') == 'pengurus')>Pengurus</option>
            <option value="bendahara" @selected(old('role') == 'bendahara')>Bendahara</option>
            <option value="anggota" @selected(old('role') == 'anggota')>Anggota</option>
        </select>

        <label for="is_active">Status Akun</label>
        <select id="is_active" name="is_active" required>
            <option value="1" @selected(old('is_active', '1') == '1')>Aktif</option>
            <option value="0" @selected(old('is_active') === '0')>Tidak Aktif</option>
        </select>

        <button type="submit" class="btn save">Simpan User</button>
        <a href="{{ route('users.index') }}" class="btn back">Kembali</a>
    </form>
</div>
</body>
</html>
```