<?php

namespace Database\Factories\History;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class HistoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create()->id,
            'ip' => fake()->title(),
            'action' => fake()->title(),
        ];
    }
}
