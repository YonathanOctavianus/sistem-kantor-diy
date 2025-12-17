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
    // Tambah kolom 'bidang' ke tabel users
    Schema::table('users', function (Blueprint $table) {
        $table->string('bidang')->nullable()->after('email'); // Misal: Divisi Imigrasi
    });

    // Tambah detail ke tabel peminjaman
    Schema::table('peminjaman', function (Blueprint $table) {
        $table->string('tipe_kegiatan')->nullable()->after('jumlah_peserta'); // Online/Offline
        $table->string('layout')->nullable()->after('tipe_kegiatan'); // Classroom, U-Shape
        $table->text('link_zoom')->nullable()->after('keperluan'); // Link jika online
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) { $table->dropColumn('bidang'); });
    Schema::table('peminjaman', function (Blueprint $table) { 
        $table->dropColumn(['tipe_kegiatan', 'layout', 'link_zoom']); 
    });
}
};