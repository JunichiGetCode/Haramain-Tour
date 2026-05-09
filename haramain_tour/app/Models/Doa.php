<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doa extends Model
{
    protected $fillable = [
        'category', 'title', 'arabic', 'latin', 'translation', 'order',
    ];
}
