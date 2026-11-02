
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pinjaman', function (Blueprint $table) {
            // Data pencairan
            $table->decimal('jumlah_pencairan', 15, 2)
                ->nullable()
                ->after('approved_by');

            $table->date('tanggal_pencairan')
                ->nullable()
                ->after('jumlah_pencairan');

            // Petugas yang mencairkan dana
            $table->foreignId('disbursed_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Data pelunasan
            $table->date('tanggal_pelunasan')
                ->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('pinjaman', function (Blueprint $table) {
            $table->dropForeign(['disbursed_by']);

            $table->dropColumn([
                'jumlah_pencairan',
                'tanggal_pencairan',
                'disbursed_by',
                'tanggal_pelunasan',
            ]);
        });
    }
};
