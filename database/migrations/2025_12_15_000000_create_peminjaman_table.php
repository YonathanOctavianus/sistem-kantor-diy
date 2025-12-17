<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Perhatikan ini: constrained('fasilitas') akan mencari tabel 'fasilitas'
            // yang dibuat di file tanggal 14 tadi.
            $table->foreignId('fasilitas_id')->constrained('fasilitas')->onDelete('cascade');
            
            $table->date('tanggal_peminjaman');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->string('keperluan');
            $table->integer('jumlah_peserta');
            $table->enum('status', ['menunggu', 'disetujui', 'ditolak', 'batal'])->default('menunggu');
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};