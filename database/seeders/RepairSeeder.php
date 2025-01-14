<?php

namespace Database\Seeders;

use App\Models\Repair;
use Illuminate\Database\Seeder;

class RepairSeeder extends Seeder
{
    public function run()
    {
        // Tworzenie przykładowych napraw
        Repair::factory(10)->create(); // Tworzy 10 napraw
    }
}
