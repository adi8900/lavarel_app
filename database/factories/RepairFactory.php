<?php

namespace Database\Factories;

use App\Models\Device;
use App\Models\RepairStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Repair>
 */
class RepairFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'device_id' => Device::factory(),
            'status_id' => RepairStatus::factory(),
            'assigned_to' => User::factory(),
            'description' => $this->faker->text(),
            'cost' => $this->faker->randomFloat(2, 10, 1000),
        ];
    }
}
