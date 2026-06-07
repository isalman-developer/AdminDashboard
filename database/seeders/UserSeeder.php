<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
            'status' => 'active',
        ]);

        $admin->assignRole('Super Admin');

        $users = User::factory()->count(10)->create([
            'status' => 'active',
        ]);

        $users->each(function ($user) {
            $user->assignRole('User');
        });
    }
}
