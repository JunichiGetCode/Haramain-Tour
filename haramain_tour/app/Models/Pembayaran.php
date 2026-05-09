<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = [
        'pendaftaran_id',
        'amount',
        'payment_status',
        'snap_token',
        'midtrans_order_id',
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }
}

