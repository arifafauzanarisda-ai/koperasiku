<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Simpanan extends Model
{
    protected $table = 'simpanans';

    protected $fillable = [
        'anggota_id',
        'no_transaksi',
        'jenis_simpanan',
        'jumlah',
        'tanggal',
        'keterangan',
    ];

    protected function casts(): array
    {
        return [
            'jumlah' => 'decimal:2',
            'tanggal' => 'date',
        ];
    }

    public function anggota(): BelongsTo
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }
}
