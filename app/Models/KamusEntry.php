<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KamusEntry extends Model
{
    protected $fillable = [
        'category', 'arabic', 'latin', 'indonesian', 'order',
    ];
}
