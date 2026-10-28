<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pinjaman extends Model
{
    protected $table = 'pinjaman';

    protected $fillable = [
        'anggota_id',
        'jumlah_pengajuan',
        'jumlah_disetujui',
        'bunga_persen',
        'tenor_bulan',
        'status',
        'approved_by',
    ];

    public function anggota(): BelongsTo
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }

    public function angsurans(): HasMany
    {
        return $this->hasMany(Angsuran::class, 'pinjaman_id');
    }
}
