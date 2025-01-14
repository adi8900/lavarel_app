<?php

namespace Database\Seeders;

use App\Models\Log;
use Illuminate\Database\Seeder;

class LogSeeder extends Seeder
{
    public function run()
    {
        // Tworzenie przykładowych logów
        Log::factory(10)->create(); // Tworzy 10 logów
    }
}

