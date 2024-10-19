<?php

namespace Database\Factories\Iptv;

use Illuminate\Database\Eloquent\Factories\Factory;

class BanIpFactory extends Factory
{
    public function definition(): array
    {
        return [
            'ip' => fake()->ipv4,
        ];
    }
}
