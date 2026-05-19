<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class UserRoleUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'roles'          => ['nullable', 'array'],
            'roles.*'        => ['exists:roles,name'],
            'permissions'    => ['nullable', 'array'],
            'permissions.*'  => ['exists:permissions,name'],
        ];
    }

    public function messages(): array
    {
        return [
            'roles.*.exists'       => 'Invalid role selected.',
            'permissions.*.exists' => 'Invalid permission selected.',
        ];
    }

    public function attributes(): array
    {
        return [
            'roles'       => 'Roles',
            'permissions' => 'Permissions',
        ];
    }
}
