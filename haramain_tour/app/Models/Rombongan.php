<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rombongan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kode',
        'ketua_id',
        'kota_asal',
        'hotel_makkah',
        'hotel_madinah',
        'safe_zone_lat',
        'safe_zone_lng',
        'safe_zone_radius',
        'status',
    ];

    protected $casts = [
        'safe_zone_lat' => 'decimal:7',
        'safe_zone_lng' => 'decimal:7',
        'safe_zone_radius' => 'integer',
    ];

    public function ketua()
    {
        return $this->belongsTo(User::class, 'ketua_id');
    }

    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class);
    }

    public function jadwalBus()
    {
        return $this->hasMany(JadwalBus::class);
    }

    /**
     * Hitung jumlah jamaah dalam rombongan ini
     */
    public function getTotalJamaahAttribute(): int
    {
        return $this->pendaftarans()->where('status', 'approved')->count();
    }
}
