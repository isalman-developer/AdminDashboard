<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SliderStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('sliders.create') ?? false;
    }

    public function rules(): array
    {
        return [
            'title' => ['nullable', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'image' => ['required', 'file', 'mimes:jpg,jpeg,png,webp,avif', 'max:4096'],
            'status' => ['boolean'],
        ];
    }
}
