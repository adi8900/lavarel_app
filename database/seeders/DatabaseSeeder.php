<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Uruchamiamy seedery dla każdego modelu
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            DeviceSeeder::class,
            RepairSeeder::class,
            PaymentSeeder::class,
            InvoiceSeeder::class,
            LogSeeder::class,
        ]);
    }
}

