
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('angsurans', 'pinjaman_id')) {
            Schema::table('angsurans', function (Blueprint $table) {
                $table->foreignId('pinjaman_id')
                    ->nullable()
                    ->constrained('pinjaman')
                    ->nullOnDelete();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('angsurans', 'pinjaman_id')) {
            Schema::table('angsurans', function (Blueprint $table) {
                $table->dropForeign(['pinjaman_id']);
                $table->dropColumn('pinjaman_id');
            });
        }
    }
};
