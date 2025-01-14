<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    public function run()
    {
        // Tworzenie przykładowych płatności
        Payment::factory(10)->create(); // Tworzy 10 płatności
    }
}

