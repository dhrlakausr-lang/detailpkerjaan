<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('user')->after('password');
            }
        });

        Schema::table('lamarans', function (Blueprint $table) {
            if (! Schema::hasColumn('lamarans', 'status')) {
                $table->string('status')->default('menunggu')->after('cv');
            }
        });
    }

    public function down(): void
    {
        Schema::table('lamarans', function (Blueprint $table) {
            if (Schema::hasColumn('lamarans', 'status')) {
                $table->dropColumn('status');
            }
        });

        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'role')) {
                $table->dropColumn('role');
            }
        });
    }
};
