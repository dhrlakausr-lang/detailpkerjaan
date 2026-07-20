<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasTable('jobs')) {
            Schema::create('jobs', function (Blueprint $table) {
                $table->id();
                $table->string('title', 100)->nullable();
                $table->string('company', 100)->nullable();
                $table->string('location', 100)->nullable();
                $table->string('salary', 50)->nullable();
                $table->text('description')->nullable();
            });
        }

        if (! Schema::hasTable('pelamar')) {
            Schema::create('pelamar', function (Blueprint $table) {
                $table->id();
                $table->string('username', 100)->nullable();
                $table->string('email', 100)->nullable();
                $table->unsignedBigInteger('job_id')->nullable();
                $table->timestamp('created_at')->useCurrent();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelamar');
        Schema::dropIfExists('jobs');
    }
};
