<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = $this->user();
        if ($user === null) {
            return false;
        }

        return $this->isMethod('POST')
            ? $user->can('brands.create')
            : $user->can('brands.update');
    }

    public function rules(): array
    {
        return [
            'name'        => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'logo'        => ['nullable', 'file', 'image', 'max:2048'],
            'website'     => ['nullable', 'url', 'max:255'],
            'is_active'   => ['boolean'],
        ];
    }
}
