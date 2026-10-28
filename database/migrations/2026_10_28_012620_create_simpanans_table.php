
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('simpanans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('anggota_id')
                ->constrained('anggota')
                ->cascadeOnDelete();

            $table->string('no_transaksi', 30)->unique();

            $table->enum('jenis_simpanan', [
                'pokok',
                'wajib',
                'sukarela',
            ]);

            $table->decimal('jumlah', 15, 2);
            $table->date('tanggal');
            $table->text('keterangan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('simpanans');
    }
};
