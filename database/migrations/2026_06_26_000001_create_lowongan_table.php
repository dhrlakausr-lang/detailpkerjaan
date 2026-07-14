<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lowongan', function (Blueprint $table) {
            $table->id();
            $table->string('posisi');
            $table->string('perusahaan')->nullable();
            $table->string('lokasi');
            $table->string('kategori');
            $table->string('tipe_kerja')->default('Full-time');       // Full-time, Part-time, Kontrak, Magang, Freelance
            $table->string('pengaturan_kerja')->default('Onsite');    // Onsite, Remote, Hybrid
            $table->string('level')->default('Entry Level');          // Fresh Graduate, Entry Level, Mid Level, Senior
            $table->unsignedBigInteger('gaji_min')->nullable();
            $table->unsignedBigInteger('gaji_max')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lowongan');
    }
};
