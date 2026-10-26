```blade
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - KoperasiKu</title>

    <style>
        * {
            box-sizing: border-box;
        }

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

        h1 {
            margin-top: 0;
        }

        .subtitle {
            color: #64748b;
            margin-bottom: 24px;
        }

        label {
            display: block;
            margin: 17px 0 7px;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 11px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            font-size: 15px;
        }

        small {
            display: block;
            margin-top: 7px;
            color: #64748b;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 25px;
        }

        .btn {
            padding: 11px 16px;
            border: none;
            border-radius: 6px;
            color: white;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }

        .save {
            background: #2563eb;
        }

        .back {
            background: #64748b;
        }
    </style>
</head>

<body>
<div class="container">
    <h1>Edit User</h1>

    <p class="subtitle">
        Perbarui informasi pengguna KoperasiKu.
    </p>

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

    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="name">Nama Lengkap</label>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $user->name) }}"
            required
        >

        <label for="email">Email</label>
        <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email', $user->email) }}"
            required
        >

        <label for="password">Password Baru</label>
        <input
            type="password"
            id="password"
            name="password"
            minlength="8"
            autocomplete="new-password"
        >
        <small>
            Kosongkan jika tidak ingin mengubah password.
            Jika diisi, minimal 8 karakter.
        </small>

        <label for="role">Role Pengguna</label>
        <select id="role" name="role" required>
            <option value="admin"
                @selected(old('role', $user->role) == 'admin')>
                Admin
            </option>

            <option value="pengurus"
                @selected(old('role', $user->role) == 'pengurus')>
                Pengurus
            </option>

            <option value="bendahara"
                @selected(old('role', $user->role) == 'bendahara')>
                Bendahara
            </option>

            <option value="anggota"
                @selected(old('role', $user->role) == 'anggota')>
                Anggota
            </option>
        </select>

        <label for="is_active">Status Akun</label>
        <select id="is_active" name="is_active" required>
            <option value="1"
                @selected((string) old('is_active', (int) $user->is_active) === '1')>
                Aktif
            </option>

            <option value="0"
                @selected((string) old('is_active', (int) $user->is_active) === '0')>
                Tidak Aktif
            </option>
        </select>

        <div class="actions">
            <button type="submit" class="btn save">
                Simpan Perubahan
            </button>

            <a href="{{ route('users.index') }}" class="btn back">
                Batal
            </a>
        </div>
    </form>
</div>
</body>
</html>
```