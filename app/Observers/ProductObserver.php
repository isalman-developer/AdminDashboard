<?php

namespace App\Observers;

use App\Concerns\GeneratesUniqueSlug;
use App\Models\Product;

class ProductObserver
{
    use GeneratesUniqueSlug;

    public function creating(Product $product): void
    {
        $this->ensureUniqueSlug($product);
    }

    public function updating(Product $product): void
    {
        if ($product->isDirty('name')) {
            $this->ensureUniqueSlug($product);
        }
    }
}
