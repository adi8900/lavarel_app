<?php

namespace Database\Seeders;

use App\Models\RepairStatus;
use Illuminate\Database\Seeder;

class RepairStatusSeeder extends Seeder
{
    public function run()
    {
        $statuses = ['Pending', 'In Progress', 'Completed'];

        foreach ($statuses as $status) {
            // Tworzy rekord tylko wtedy, gdy nie istnieje
            RepairStatus::firstOrCreate(['name' => $status]);
        }
    }
}
