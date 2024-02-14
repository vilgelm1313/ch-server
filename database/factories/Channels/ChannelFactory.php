<?php

namespace Database\Factories\Channels;

use Illuminate\Database\Eloquent\Factories\Factory;

class ChannelFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->title(),
            'comment' => fake()->title(),
            'logo' => fake()->title(),
            'epg_key' => 'test',
            'smartiptv' => fake()->title(),
            'url' => fake()->url(),
            'dvr' => 1,
            'is_active' => true,
            'is_external' => false,
        ];
    }
}
