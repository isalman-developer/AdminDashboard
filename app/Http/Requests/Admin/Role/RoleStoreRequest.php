<?php

namespace App\Http\Requests\Admin\Role;

use Illuminate\Foundation\Http\FormRequest;

class RoleStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('roles.create') ?? false;
    }

    public function rules(): array
    {
        return [
            'name'           => ['required', 'string', 'max:255', 'unique:roles,name'],
            'permissions'    => ['nullable', 'array'],
            'permissions.*'  => ['exists:permissions,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'          => 'Role name is required.',
            'name.unique'            => 'Role name already exists.',
            'permissions.*.exists'   => 'Invalid permission selected.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name'        => 'Role name',
            'permissions' => 'Permissions',
        ];
    }
}
