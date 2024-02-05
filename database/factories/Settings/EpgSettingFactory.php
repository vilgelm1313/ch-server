<?php

namespace Database\Factories\Settings;

use Illuminate\Database\Eloquent\Factories\Factory;

class EpgSettingFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->title(),
            'url' => fake()->title(),
            'is_active' => true,
            'refresh_period' => 1,
        ];
    }
}
