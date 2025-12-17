<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('permintaan_atks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama_peminta');
            $table->string('bidang');
            $table->string('status')->default('pending'); // pending, approved, rejected, processed, completed
            $table->dateTime('tanggal_permintaan');
            $table->dateTime('tanggal_disetujui')->nullable();
            $table->dateTime('tanggal_diterima')->nullable();
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
        });
        
        Schema::create('permintaan_atk_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('permintaan_id')->constrained('permintaan_atks')->onDelete('cascade');
            $table->foreignId('atk_id')->constrained('atk')->onDelete('cascade');
            $table->string('nama_barang');
            $table->integer('jumlah');
            $table->string('satuan');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('permintaan_atk_items');
        Schema::dropIfExists('permintaan_atks');
    }
};