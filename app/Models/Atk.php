<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atk extends Model
{
    use HasFactory;

    // Tentukan nama tabel
    protected $table = 'atk';
    
    protected $fillable = [
        'nama_barang',
        'jenis',
        'kode_barang',
        'stok',
        'min_stok',
        'satuan',
        'lokasi_penyimpanan',
        'keterangan',
    ];
    
    protected $attributes = [
        'stok' => 0,
        'min_stok' => 5,
    ];
}