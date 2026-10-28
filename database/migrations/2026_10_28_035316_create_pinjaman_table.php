
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pinjaman', function (Blueprint $table) {
            $table->id();

            $table->foreignId('anggota_id')
                ->nullable()
                ->constrained('anggota')
                ->nullOnDelete();

            $table->decimal('jumlah_pengajuan', 15, 2)->default(0);
            $table->decimal('jumlah_disetujui', 15, 2)->default(0);
            $table->decimal('bunga_persen', 5, 2)->default(0);
            $table->unsignedInteger('tenor_bulan')->default(1);
            $table->string('status')->default('diajukan');
            $table->unsignedBigInteger('approved_by')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pinjaman');
    }
};
