<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IbadahProgress extends Model
{
    protected $table = 'ibadah_progress';
    
    protected $fillable = [
        'user_id',
        'ibadah_id',
        'hari_ke',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
