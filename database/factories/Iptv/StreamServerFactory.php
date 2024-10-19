<?php

namespace Database\Factories\Iptv;

use Illuminate\Database\Eloquent\Factories\Factory;

class StreamServerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'is_active' => true,
            'index' => fake()->numberBetween(1, 100),
            'address' => fake()->ipv4,
            'port' => fake()->numberBetween(1000, 65535),
        ];
    }
}
