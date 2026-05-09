<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;

    protected $table = 'notifikasis';

    protected $fillable = [
        'user_id',
        'pendaftaran_id',
        'judul',
        'pesan',
        'tipe',
        'dibaca',
    ];

    protected $casts = [
        'dibaca' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }

    /**
     * Icon berdasarkan tipe
     */
    public function getIconAttribute()
    {
        return match ($this->tipe) {
            'success' => 'fa-circle-check',
            'danger' => 'fa-circle-xmark',
            'warning' => 'fa-clock',
            'info' => 'fa-circle-info',
            default => 'fa-bell',
        };
    }

    /**
     * Warna berdasarkan tipe
     */
    public function getWarnaAttribute()
    {
        return match ($this->tipe) {
            'success' => '#10b981',
            'danger' => '#ef4444',
            'warning' => '#f59e0b',
            'info' => '#3b82f6',
            default => '#6b7280',
        };
    }

    /**
     * Boot the model to listen for events.
     */
    protected static function booted()
    {
        static::created(function ($notifikasi) {
            // Automatically send email when notification is created
            if ($notifikasi->user && $notifikasi->user->email) {
                try {
                    \Illuminate\Support\Facades\Mail::to($notifikasi->user->email)
                        ->send(new \App\Mail\UserNotificationMail($notifikasi));
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::error('Failed to send notification email: ' . $e->getMessage());
                }
            }
        });
    }
}
