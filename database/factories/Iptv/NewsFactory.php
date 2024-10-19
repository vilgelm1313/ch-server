<?php

namespace Database\Factories\Iptv;

use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->name,
            'text' => fake()->paragraph(3),
            'is_active' => true,
        ];
    }
}
