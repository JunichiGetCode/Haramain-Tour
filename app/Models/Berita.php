<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $fillable = [
        'judul',
        'slug',
        'thumbnail',
        'konten',
        'status',
        'user_id',
    ];

    /**
     * Get the user that authored the news.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
