<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('products.create') ?? false;
    }

    public function rules(): array
    {
        return [
            'category_id'    => ['nullable', 'integer', 'exists:categories,id'],
            'name'           => ['required', 'string', 'max:255'],
            'sku'            => ['nullable', 'string', 'max:100', 'unique:products,sku'],
            'description'    => ['nullable', 'string'],
            'price'          => ['required', 'numeric', 'min:0'],
            'stock_quantity' => ['required', 'integer', 'min:0'],
            'warranty_months' => ['nullable', 'integer', 'min:0'],
            'discount_percent' => ['nullable', 'integer', 'min:0', 'max:100'],
            'is_active'      => ['boolean'],
            'image'          => ['nullable', 'file', 'image', 'max:2048'],
        ];
    }
}
