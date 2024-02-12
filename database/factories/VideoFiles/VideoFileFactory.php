<?php

namespace Database\Factories\VideoFiles;

use Illuminate\Database\Eloquent\Factories\Factory;

class VideoFileFactory extends Factory
{
    public function definition(): array
    {
        return [
            'path' => fake()->title(),
            'poster' => fake()->title(),
            'title' => fake()->title(),
            'original_title' => fake()->title(),
            'kinopoisk_url' => fake()->title(),
            'imbd' => 1,
            'kinopoisk' => 5,
            'description' => fake()->title(),
            'is_active' => true,
            'show_start' => fake()->date,
            'show_end' => fake()->date,
            'year' => 2023,
            'country' => fake()->title(),
            'director' => fake()->title(),
            'actors' => fake()->title(),
        ];
    }
}
