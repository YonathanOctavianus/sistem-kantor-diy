<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // PERBAIKAN: Pastikan di sini tertulis 'fasilitas', BUKAN 'peminjaman'
        Schema::create('fasilitas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_fasilitas');
            $table->text('deskripsi')->nullable();
            $table->string('lokasi');
            $table->integer('kapasitas')->default(1);
            $table->enum('status', ['tersedia', 'dipinjam', 'perbaikan'])->default('tersedia');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fasilitas');
    }
};