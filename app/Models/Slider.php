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

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function getImagePathAttribute(): string
    {
        return $this->image
            ?? optional($this->media->firstWhere('file_type', 'image'))->file_path
            ?? '';
    }
}
