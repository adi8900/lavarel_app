<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create an admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role' => User::ROLE_ADMIN,
        ]);

        // Create workers
        User::factory(5)->create([
            'role' => User::ROLE_WORKER,
        ]);

        // Create regular users
        User::factory(10)->create([
            'role' => User::ROLE_USER,
        ]);
    }
}
