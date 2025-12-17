<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanAtkItem extends Model
{
    use HasFactory;

    protected $table = 'permintaan_atk_items';
    
    protected $fillable = [
        'permintaan_id',
        'atk_id',
        'nama_barang',
        'jumlah',
        'satuan',
        'keterangan',
    ];
    
    // Relationship dengan Permintaan
    public function permintaan()
    {
        return $this->belongsTo(PermintaanAtk::class, 'permintaan_id');
    }
    
    // Relationship dengan ATK
    public function atk()
    {
        return $this->belongsTo(Atk::class, 'atk_id');
    }
}