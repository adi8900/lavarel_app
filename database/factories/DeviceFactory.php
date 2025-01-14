<?php

namespace Database\Factories;

use App\Models\Device;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeviceFactory extends Factory
{
    protected $model = Device::class;

    public function definition()
    {
        return [
            'brand' => $this->faker->company,
            'model' => $this->faker->word,
            'serial_number' => $this->faker->unique()->bothify('SN-####-####'), // Unikalny numer seryjny
            'user_id' => \App\Models\User::factory(),
        ];
    }
}

