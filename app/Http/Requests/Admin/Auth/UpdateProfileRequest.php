<?php

namespace App\Http\Requests\Admin\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Override;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255'],
            'username' => ['nullable', 'string', 'max:255', 'alpha_dash'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'avatar'   => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'          => 'Name is required.',
            'email.required'         => 'Email is required.',
            'email.email'            => 'Please provide a valid email address.',
            'username.alpha_dash'    => 'Username may only contain letters, numbers, dashes, and underscores.',
            'password.min'           => 'Password must be at least 8 characters.',
            'password.confirmed'     => 'Password confirmation does not match.',
            'avatar.image'           => 'Avatar must be an image file.',
            'avatar.mimes'           => 'Avatar must be jpg, jpeg, png, or webp.',
            'avatar.max'             => 'Avatar size may not exceed 2 MB.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name'                        => 'Name',
            'email'                       => 'Email',
            'username'                    => 'Username',
            'password'                    => 'Password',
            'avatar'                      => 'Profile picture',
        ];
    }
}
