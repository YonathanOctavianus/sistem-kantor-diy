<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kerusakan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('pelapor');
            $table->string('bidang');
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('lokasi');
            $table->string('kategori'); // Elektronik, Furniture, dll
            $table->string('prioritas')->default('sedang'); // rendah, sedang, tinggi
            $table->string('status')->default('dilaporkan'); // dilaporkan, diperbaiki, selesai
            $table->string('foto_bukti')->nullable();
            $table->string('teknisi')->nullable();
            $table->dateTime('tanggal_laporan');
            $table->dateTime('tanggal_perbaikan')->nullable();
            $table->dateTime('tanggal_selesai')->nullable();
            $table->decimal('biaya_perbaikan', 10, 2)->nullable();
            $table->text('catatan_teknisi')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kerusakan');
    }
};