<?php

namespace Database\Seeders;

use App\Models\Device;
use Illuminate\Database\Seeder;

class DeviceSeeder extends Seeder
{
    public function run()
    {
        // Tworzenie przykładowych urządzeń
        Device::factory(10)->create(); // Tworzy 100 urządzeń
    }
}