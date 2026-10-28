<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('anggota', function (Blueprint $table) {
            if (!Schema::hasColumn('anggota', 'jenis_kelamin')) {
                $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            }

            if (!Schema::hasColumn('anggota', 'tempat_lahir')) {
                $table->string('tempat_lahir')->nullable();
            }

            if (!Schema::hasColumn('anggota', 'tanggal_lahir')) {
                $table->date('tanggal_lahir')->nullable();
            }

            if (!Schema::hasColumn('anggota', 'no_hp')) {
                $table->string('no_hp')->nullable();
            }

            if (!Schema::hasColumn('anggota', 'email')) {
                $table->string('email')->nullable();
            }

            if (!Schema::hasColumn('anggota', 'tanggal_bergabung')) {
                $table->date('tanggal_bergabung')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('anggota', function (Blueprint $table) {
            $columns = [
                'jenis_kelamin',
                'tempat_lahir',
                'tanggal_lahir',
                'no_hp',
                'email',
                'tanggal_bergabung',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('anggota', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};