<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'brand_id',
        'marked_as_id',
        'name',
        'slug',
        'sku',
        'series',
        'processor',
        'processor_type',
        'generation',
        'ram',
        'ram_type',
        'storage',
        'graphical_memory',
        'screen_size',
        'color',
        'backlight',
        'price',
        'discount_percent',
        'stock_quantity',
        'warranty_months',
        'description',
        'is_active',
        'status',
    ];

    public function getBackLightAttribute($value)
    {
        return $value == 1 ? 'Yes' : 'No';
    }

    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function getImagePathAttribute(): string
    {
        return optional($this->media->firstWhere('file_type', 'image'))->file_path ?? '';
    }

    //second image path
    public function getImagePath2Attribute(): string
    {
        return optional($this->media->where('file_type', 'image')->skip(1)->first())->file_path ?? '';
    }
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class)->withDefault();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class)->withDefault();
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
