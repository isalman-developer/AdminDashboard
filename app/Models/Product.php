<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'brand_id',
        'title',
        'series',
        'ram',
        'ram_type',
        'storage',
        'graphical_memory',
        'backlight',
        'screen_size',
        'color',
        'price',
        'marked_as_id',
        'generation_id',
        'processor_id',
        'processor_type',
        'description',
    ];

    public function getBackLightAttribute($value)
    {
        return $value == 1 ? 'Yes' : 'No';
    }

    public function getMarkedAsAttribute($value)
    {
        return ucwords(str_replace('_', ' ', $value));
    }

    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class)->withDefault()->withTrashed();
    }

    public function generation(): BelongsTo
    {
        return $this->belongsTo(Generation::class)->withDefault()->withTrashed();
    }

    public function processor(): BelongsTo
    {
        return $this->belongsTo(Processor::class)->withDefault()->withTrashed();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class)->withDefault()->withTrashed();
    }

    public function markedAs(): BelongsTo
    {
        return $this->belongsTo(MarkedAs::class)->withDefault();
    }

    public function getMarkedAsNameAttribute()
    {
        return $this->markedAs->name ?? 'Normal';
    }
}
