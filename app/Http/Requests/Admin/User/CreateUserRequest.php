<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() !== null && $this->user()->can('users.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['nullable', 'string', 'max:255', 'alpha_dash', Rule::unique('users', 'username')],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email'),
            ],
            'password' => ['required', 'confirmed', Password::min(8)],
            'status' => ['required', 'string', Rule::in(['active', 'inactive', 'blocked'])],
            'referral_code' => ['nullable', 'string', 'max:255', 'exists:users,referral_code'],
            'roles' => ['nullable', 'array'],
            'roles.*' => ['exists:roles,name'],
        ];
    }

    public function messages(): array
    {
        return [
            'username.unique'        => 'This username is already taken.',
            'email.unique'           => 'This email address is already in use.',
            'password.confirmed'     => 'The password confirmation does not match.',
            'status.in'              => 'Invalid status selected.',
            'referral_code.exists'   => 'The referral code you entered does not exist.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Name',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'password_confirmation' => 'Password Confirmation',
            'status' => 'Status',
            'roles' => 'Roles',
        ];
    }
}
