<?php

namespace Database\Factories\Settings;

use Illuminate\Database\Eloquent\Factories\Factory;

class TariffFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'is_active' => true,
            'key' => fake()->name,
        ];
    }
}
