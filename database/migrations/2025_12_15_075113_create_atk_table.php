<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('atk', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('jenis'); // Alat Tulis, Kertas, Elektronik
            $table->string('kode_barang')->unique();
            $table->integer('stok')->default(0);
            $table->integer('min_stok')->default(5);
            $table->string('satuan'); // pcs, pak, rim
            $table->string('lokasi_penyimpanan');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('atk');
    }
};