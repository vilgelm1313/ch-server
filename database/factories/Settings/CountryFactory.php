<?php

namespace Database\Factories\Settings;

use Illuminate\Database\Eloquent\Factories\Factory;

class CountryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'code' => fake()->countryCode(),
            'name' => fake()->country(),
            'is_active' => true,
        ];
    }
}
