<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SliderUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('sliders.update') ?? false;
    }

    public function rules(): array
    {
        return [
            'title' => ['nullable', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,avif', 'max:4096'],
            'status' => ['boolean'],
        ];
    }
}
