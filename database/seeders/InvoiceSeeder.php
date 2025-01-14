<?php

namespace Database\Seeders;

use App\Models\Invoice;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    public function run()
    {
        // Tworzenie przykładowych faktur
        Invoice::factory(10)->create(); // Tworzy 10 faktur
    }
}

