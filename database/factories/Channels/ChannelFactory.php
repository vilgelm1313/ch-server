<?php

namespace Database\Factories\Channels;

use App\Models\EPG\Epg;
use App\Models\Settings\Category;
use App\Models\Settings\Country;
use App\Models\Settings\Tariff;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChannelFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->title(),
            'comment' => fake()->title(),
            'logo' => fake()->title(),
            'category_id' => Category::factory()->create()->id,
            'country_id' => Country::factory()->create()->id,
            'epg_key' => 'test',
            'smartiptv' => fake()->title(),
            'ssiptv' => fake()->title(),
            'index' => fake()->title(),
            'tariff_id' => Tariff::factory()->create()->id,
            'is_test' => false,
            'url' => fake()->url(),
            'dvr' => 1,
            'is_hevc' => false,
            'is_active' => true,
            'is_external' => false,
        ];
    }
}
