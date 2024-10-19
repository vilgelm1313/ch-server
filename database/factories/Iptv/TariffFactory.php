<?php

namespace Database\Factories\Iptv;

use Illuminate\Database\Eloquent\Factories\Factory;

class TariffFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'is_active' => true,
            'price' => fake()->randomFloat(2, 1, 100),
        ];
    }
}
