<?php

namespace Database\Seeders;

use App\Enums\PermissionEnum;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $records = [];
        foreach (PermissionEnum::cases() as $permission) {
            $records[] = [
                'name' => $permission->value,
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        Permission::upsert($records, ['name', 'guard_name'], ['updated_at']);
    }
}
