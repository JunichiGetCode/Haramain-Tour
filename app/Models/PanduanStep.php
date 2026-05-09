<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PanduanStep extends Model
{
    protected $fillable = [
        'step_id', 'step_label', 'title', 'description', 'icon', 'order', 'sections',
    ];

    protected $casts = [
        'sections' => 'array',
    ];
}
