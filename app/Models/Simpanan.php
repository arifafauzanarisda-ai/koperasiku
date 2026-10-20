<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Simpanan extends Model
{
    protected $fillable = [
    'anggota_id',
    'jenis',
    'nominal',
    'tanggal_transaksi',
    'status',
    'created_by',
];
}
