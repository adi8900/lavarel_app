<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $adminEmail = 'admin@example.com';
        $adminPassword = 'admin123';

        // Tworzenie administratora
        $admin = User::create([
            'name' => 'Admin User',
            'email' => $adminEmail,
            'password' => Hash::make($adminPassword), // Hasło admina
            'role' => User::ROLE_ADMIN, // Rola admina
        ]);

        $this->command->info("Admin created successfully.");
        $this->command->info("Email: $adminEmail");
        $this->command->info("Password: $adminPassword");

        // Tworzenie przykładowych użytkowników
        $users = User::factory(10)->create(); // Tworzy 10 użytkowników
        $this->command->info("Created " . $users->count() . " sample users and assigned user_id.");
    }
}
