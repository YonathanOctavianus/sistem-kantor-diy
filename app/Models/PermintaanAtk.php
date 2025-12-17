<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanAtk extends Model
{
    use HasFactory;

    protected $table = 'permintaan_atks';
    
    protected $fillable = [
        'user_id',
        'nama_peminta',
        'bidang',
        'status',
        'tanggal_permintaan',
        'tanggal_disetujui',
        'tanggal_diterima',
        'catatan_admin',
    ];
    
    protected $casts = [
        'tanggal_permintaan' => 'datetime',
        'tanggal_disetujui' => 'datetime',
        'tanggal_diterima' => 'datetime',
    ];
    
    // Relationship dengan User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    // Relationship dengan items
    public function items()
    {
        return $this->hasMany(PermintaanAtkItem::class, 'permintaan_id');
    }
}