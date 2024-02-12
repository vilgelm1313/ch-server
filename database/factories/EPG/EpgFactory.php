<?php

namespace Database\Factories\EPG;

use App\Models\Settings\EpgSetting;
use Illuminate\Database\Eloquent\Factories\Factory;

class EpgFactory extends Factory
{
    public function definition(): array
    {
        return [
            'start' => fake()->date,
            'end' => fake()->date,
            'title' => fake()->title(),
            'sub_title' => fake()->title(),
            'description' => fake()->title(),
            'language' => fake()->languageCode(),
            'epg_setting_id' => EpgSetting::factory()->create()->id,
        ];
    }
}
