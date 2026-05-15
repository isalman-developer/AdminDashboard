<?php

namespace Database\Seeders;

use App\Enums\PermissionEnum;
use App\Enums\RoleEnum;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            $roleModel = Role::create([
                'name' => $role->value
            ]);

            if ($roleModel->name == RoleEnum::SuperAdmin->value) {
                $roleModel->permissions()->sync(Permission::all()->pluck('id'));
            } else {
                $permissions = Permission::whereIn('name', PermissionEnum::userPermissions())->pluck('id');
                $roleModel->permissions()->sync($permissions);
            }
        }
    }
}
