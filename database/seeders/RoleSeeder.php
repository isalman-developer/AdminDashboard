<?php

namespace Database\Seeders;

use App\Enums\PermissionEnum;
use App\Enums\RoleEnum;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = RoleEnum::cases();
        foreach ($roles as $role) {
            $roleModel = Role::findOrCreate($role->value);

            if ($roleModel->name == RoleEnum::SuperAdmin->value) {
                // Super Admin — every permission
                $roleModel->permissions()->sync(Permission::all()->pluck('id'));
            } elseif ($roleModel->name == RoleEnum::Admin->value) {
                // Admin — full user CRUD, roles, and settings
                $roleModel->permissions()->sync(
                    Permission::whereIn('name', [
                        PermissionEnum::USERS_VIEW->value,
                        PermissionEnum::USERS_CREATE->value,
                        PermissionEnum::USERS_UPDATE->value,
                        PermissionEnum::USERS_DELETE->value,
                        PermissionEnum::ROLES_VIEW->value,
                        PermissionEnum::ROLES_CREATE->value,
                        PermissionEnum::ROLES_UPDATE->value,
                        PermissionEnum::ROLES_DELETE->value,
                    ])->pluck('id')
                );
            } else {
                // User (and any future base roles) — only view
                $roleModel->permissions()->sync(
                    Permission::where('name', PermissionEnum::USERS_VIEW->value)->pluck('id')
                );
            }
        }
    }
}
