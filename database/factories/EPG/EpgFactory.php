<?php

namespace Database\Factories\EPG;

use Illuminate\Database\Eloquent\Factories\Factory;

class EpgFactory extends Factory
{
    public function definition(): array
    {
        return [
            'key' => fake()->title(),
            'start' => fake()->date,
            'end' => fake()->date,
            'title' => fake()->title(),
            'sub_title' => fake()->title(),
            'description' => fake()->title(),
            'lang' => fake()->languageCode(),
            'event' => fake()->title(),
        ];
    }
}
