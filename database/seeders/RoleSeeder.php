<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Tworzenie przykładowych ról
        Role::factory(2)->create(); // Tworzy 5 ról
    }
}
