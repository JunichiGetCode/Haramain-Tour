<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kategori',
        'durasi_hari',
        'tanggal_keberangkatan',
        'hotel_makkah',
        'hotel_madinah',
        'harga',
        'harga_label',
        'rating',
        'deskripsi',
        'fasilitas',
        'gambar_utama',
        'gambar_rincian',
        'status_populer',
        'status_premium',
    ];

    protected $casts = [
        'tanggal_keberangkatan' => 'date',
        'fasilitas' => 'array',
        'gambar_rincian' => 'array',
        'status_populer' => 'boolean',
        'status_premium' => 'boolean',
    ];

    /**
     * Dapatkan harga dalam format Rupiah
     */
    public function getHargaRupiahAttribute()
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    public function pendaftarans()
    {
        return $this->hasMany(\App\Models\Pendaftaran::class);
    }
}
