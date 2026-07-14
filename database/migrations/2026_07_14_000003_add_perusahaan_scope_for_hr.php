<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumn('users', 'perusahaan_hr')) {
                $table->string('perusahaan_hr')->nullable()->after('jenis_lamaran');
            }
        });

        Schema::table('lamarans', function (Blueprint $table) {
            if (! Schema::hasColumn('lamarans', 'perusahaan')) {
                $table->string('perusahaan')->nullable()->after('posisi');
            }
        });
    }

    public function down(): void
    {
        Schema::table('lamarans', function (Blueprint $table) {
            if (Schema::hasColumn('lamarans', 'perusahaan')) {
                $table->dropColumn('perusahaan');
            }
        });

        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'perusahaan_hr')) {
                $table->dropColumn('perusahaan_hr');
            }
        });
    }
};
