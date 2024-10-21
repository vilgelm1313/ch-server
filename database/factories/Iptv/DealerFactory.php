<?php

namespace Database\Factories\Iptv;

use App\Models\Iptv\VideoServer;
use Illuminate\Database\Eloquent\Factories\Factory;

class DealerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'email' => fake()->email(),
            'password' => fake()->password(),
            'balance' => 0,
            'iptv_price' => fake()->randomFloat(2, 0, 100),
            'playlist_price' => fake()->randomFloat(2, 0, 100),
            'comment' => fake()->sentence(),
            'is_active' => fake()->boolean(),
            'video_server_id' => VideoServer::factory()->create()->id,
        ];
    }
}
