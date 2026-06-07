<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'link',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
}
