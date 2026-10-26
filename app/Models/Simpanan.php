<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Simpan extends Model
{
    protected $table = 'simpans';

    protected $fillable = [
        'anggota_id',
        'jenis',
        'nominal',
        'tanggal_transaksi',
        'status',
        'created_by',
    ];

    public function anggota(): BelongsTo
    {
        return $this->belongsTo(Anggota::class);
    }
}