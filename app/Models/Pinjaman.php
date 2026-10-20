<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    protected $fillable = [
    'anggota_id',
    'jumlah_pengajuan',
    'jumlah_disetujui',
    'bunga_persen',
    'tenor_bulan',
    'status',
    'approved_by',
];
}
