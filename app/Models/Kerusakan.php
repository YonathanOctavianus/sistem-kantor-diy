<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kerusakan extends Model
{
    use HasFactory;

    // Tentukan nama tabel
    protected $table = 'kerusakan';
    
    protected $fillable = [
        'user_id',
        'pelapor',
        'bidang',
        'judul',
        'deskripsi',
        'lokasi',
        'kategori',
        'prioritas',
        'status',
        'foto_bukti',
        'teknisi',
        'tanggal_laporan',
        'tanggal_perbaikan',
        'tanggal_selesai',
        'biaya_perbaikan',
        'catatan_teknisi',
    ];
    
    protected $casts = [
        'tanggal_laporan' => 'datetime',
        'tanggal_perbaikan' => 'datetime',
        'tanggal_selesai' => 'datetime',
        'biaya_perbaikan' => 'decimal:2',
    ];
    
    protected $attributes = [
        'status' => 'dilaporkan',
        'prioritas' => 'sedang',
    ];
    
    // Relationship dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}