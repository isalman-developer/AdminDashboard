<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'sku',
        'description',
        'price',
        'bv',
        'pv',
        'stock_quantity',
        'is_active',
        'image_path',
    ];

    protected $casts = [
        'price'         => 'decimal:2',
        'bv'            => 'integer',
        'pv'            => 'integer',
        'stock_quantity'=> 'integer',
        'is_active'     => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function inventory(): HasMany
    {
        return $this->hasMany(ProductInventory::class);
    }
}
