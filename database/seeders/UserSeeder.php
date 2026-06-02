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
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@mlm.com',
            'password' => Hash::make('12345678'),
            'referral_code' => 'admin',
            'parent_id' => null,
            'wallet_balance' => 0,
            'status' => 'active',
        ]);

        $admin->assignRole('Super Admin');

        $users = User::factory()->count(10)->create([
            'parent_id' => $admin->id,
        ]);

        $users->each(function ($user) {
            $user->assignRole('User');
        });
    }
}
