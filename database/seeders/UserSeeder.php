<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::factory()->count(10)->create();
        $users->each(function ($user) {
            $user->assignRole('User');
        });

        $admin = User::factory()->create([
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@mlm.com',
            'password' => Hash::make('12345678'),
            'parent_id' => null,
            'wallet_balance' => 0,
            'status' => 'active',
        ]);

        // assign role to admin
        $admin->assignRole('Super Admin');
    }
}
