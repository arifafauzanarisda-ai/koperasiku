
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Anggota</title>

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

        .detail {
            width: 100%;
            border-collapse: collapse;
        }

        .detail th,
        .detail td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
            vertical-align: top;
        }

        .detail th {
            width: 220px;
            background: #f3f4f6;
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

        .btn-kembali {
            background: #6b7280;
        }

        .btn-edit {
            background: #d97706;
        }

        .aksi {
            display: flex;
            gap: 8px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Detail Anggota</h1>

    <table class="detail">
        <tr>
            <th>Nomor Anggota</th>
            <td>{{ $anggota->no_anggota }}</td>
        </tr>
        <tr>
            <th>NIK</th>
            <td>{{ $anggota->nik }}</td>
        </tr>
        <tr>
            <th>Nama Lengkap</th>
            <td>{{ $anggota->nama }}</td>
        </tr>
        <tr>
            <th>Jenis Kelamin</th>
            <td>
                @if ($anggota->jenis_kelamin === 'L')
                    Laki-laki
                @elseif ($anggota->jenis_kelamin === 'P')
                    Perempuan
                @else
                    -
                @endif
            </td>
        </tr>
        <tr>
            <th>Tempat Lahir</th>
            <td>{{ $anggota->tempat_lahir ?: '-' }}</td>
        </tr>
        <tr>
            <th>Tanggal Lahir</th>
            <td>
                {{ $anggota->tanggal_lahir
                    ? $anggota->tanggal_lahir->format('d-m-Y')
                    : '-' }}
            </td>
        </tr>
        <tr>
            <th>Alamat</th>
            <td>{{ $anggota->alamat }}</td>
        </tr>
        <tr>
            <th>Nomor HP</th>
            <td>{{ $anggota->no_hp }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $anggota->email ?: '-' }}</td>
        </tr>
        <tr>
            <th>Tanggal Bergabung</th>
            <td>
                @php
                    $tanggalGabung = $anggota->tanggal_gabung
                        ?? $anggota->tanggal_bergabung;
                @endphp

                {{ $tanggalGabung
                    ? \Illuminate\Support\Carbon::parse($tanggalGabung)->format('d-m-Y')
                    : '-' }}
            </td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ ucfirst($anggota->status) }}</td>
        </tr>
    </table>

    <div class="aksi">
        <a href="{{ route('anggota.index') }}"
           class="btn btn-kembali">
            Kembali
        </a>

        <a href="{{ route('anggota.edit', $anggota->id) }}"
           class="btn btn-edit">
            Edit Anggota
        </a>
    </div>
</div>
</body>
</html>
