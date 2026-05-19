<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class SettingStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->can('settings.update') ?? false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'site_name' => ['required', 'string', 'max:255'],
            'site_email' => ['nullable', 'email', 'max:255'],
            'site_description' => ['nullable', 'string', 'max:500'],
            'items_per_page' => ['required', 'integer', 'min:5', 'max:100'], //
        ];
    }

    public function messages(): array
    {
        return [
            'site_name.required' => 'Site name is required.',
            'items_per_page.min' => 'Items per page must be at least 5.',
            'items_per_page.max' => 'Items per page cannot exceed 100.',
        ];
    }

    public function attributes(): array
    {
        return [
            'site_name' => 'Site Name',
            'site_email' => 'Site Email',
            'site_description' => 'Site Description',
            'items_per_page' => 'Items Per Page',
        ];
    }
}
