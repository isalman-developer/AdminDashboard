<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->can('products.update') ?? false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $product = $this->route('product');

        return [
            'category_id'    => ['nullable', 'integer', 'exists:categories,id'],
            'name'           => ['required', 'string', 'max:255'],
            'sku'            => [
                'nullable',
                'string',
                'max:100',
                Rule::unique('products', 'sku')->ignore($product),
            ],
            'description'    => ['nullable', 'string'],
            'price'          => ['required', 'numeric', 'min:0'],
            'bv'             => ['required', 'integer', 'min:0'],
            'pv'             => ['required', 'integer', 'min:0'],
            'stock_quantity' => ['required', 'integer', 'min:0'],
            'is_active'      => ['boolean'],
            'image'     => ['nullable', 'file', 'image', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'          => 'Name is required',
            'name.max'               => 'Name cannot be more than 255 characters',
            'sku.max'                => 'SKU cannot be more than 100 characters',
            'price.required'         => 'Price is required',
            'bv.required'            => 'BV is required',
            'pv.required'            => 'PV is required',
            'stock_quantity.required' => 'Stock Quantity is required',
        ];
    }
}
