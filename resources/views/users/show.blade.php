```blade
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail User - KoperasiKu</title>

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
            max-width: 750px;
            margin: auto;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 3px 12px #0000000a;
        }

        h1 {
            margin-top: 0;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #64748b;
            margin-bottom: 25px;
        }

        .profile {
            width: 80px;
            height: 80px;
            background: #dbeafe;
            color: #1d4ed8;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            font-weight: bold;
            margin-bottom: 25px;
        }

        .detail-row {
            display: grid;
            grid-template-columns: 180px 1fr;
            gap: 15px;
            padding: 16px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .label {
            color: #64748b;
        }

        .value {
            font-weight: 600;
            overflow-wrap: anywhere;
        }

        .badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
        }

        .active {
            background: #dcfce7;
            color: #166534;
        }

        .inactive {
            background: #fee2e2;
            color: #991b1b;
        }

        .role {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 25px;
        }

        .btn {
            display: inline-block;
            padding: 11px 16px;
            border-radius: 6px;
            text-decoration: none;
            color: white;
            font-size: 14px;
        }

        .edit {
            background: #d97706;
        }

        .back {
            background: #64748b;
        }

        @media (max-width: 520px) {
            body {
                padding: 15px;
            }

            .card {
                padding: 20px;
            }

            .detail-row {
                grid-template-columns: 1fr;
                gap: 7px;
            }
        }
    </style>
</head>

<body>
<div class="container">
    <div class="card">
        <h1>Detail User</h1>
        <p class="subtitle">
            Informasi lengkap pengguna KoperasiKu
        </p>

        <div class="profile">
            {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>

        <div class="detail-row">
            <div class="label">ID Pengguna</div>
            <div class="value">{{ $user->getKey() }}</div>
        </div>

        <div class="detail-row">
            <div class="label">Nama Lengkap</div>
            <div class="value">{{ $user->name }}</div>
        </div>

        <div class="detail-row">
            <div class="label">Email</div>
            <div class="value">{{ $user->email }}</div>
        </div>

        <div class="detail-row">
            <div class="label">Role</div>
            <div class="value">
                <span class="badge role">
                    {{ ucfirst($user->role ?? 'anggota') }}
                </span>
            </div>
        </div>

        <div class="detail-row">
            <div class="label">Status Akun</div>
            <div class="value">
                <span class="badge {{ $user->is_active ? 'active' : 'inactive' }}">
                    {{ $user->is_active ? 'Aktif' : 'Tidak Aktif' }}
                </span>
            </div>
        </div>

        <div class="detail-row">
            <div class="label">Tanggal Dibuat</div>
            <div class="value">
                {{ $user->created_at?->format('d-m-Y H:i') ?? '-' }}
            </div>
        </div>

        <div class="detail-row">
            <div class="label">Terakhir Diperbarui</div>
            <div class="value">
                {{ $user->updated_at?->format('d-m-Y H:i') ?? '-' }}
            </div>
        </div>

        <div class="actions">
            <a href="{{ route('users.edit', $user) }}"
               class="btn edit">
                Edit User
            </a>

            <a href="{{ route('users.index') }}"
               class="btn back">
                Kembali ke Data User
            </a>
        </div>
    </div>
</div>
</body>
</html>
```