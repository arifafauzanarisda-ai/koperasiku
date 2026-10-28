
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('angsurans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pinjaman_id');
            $table->unsignedInteger('angsuran_ke');
            $table->decimal('jumlah_angsuran', 15, 2);
            $table->decimal('denda', 15, 2)->default(0);
            $table->date('tanggal_jatuh_tempo');
            $table->date('tanggal_bayar')->nullable();
            $table->enum('status', ['belum_bayar', 'lunas'])
                  ->default('belum_bayar');
            $table->timestamps();

            $table->unique(
                ['pinjaman_id', 'angsuran_ke'],
                'angsurans_pinjaman_ke_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('angsurans');
    }
};
