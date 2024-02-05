<?php

namespace Database\Factories\Settings;

use Illuminate\Database\Eloquent\Factories\Factory;

class ConfigurationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'key' => fake()->title(),
            'value' => fake()->title(),
        ];
    }
}
