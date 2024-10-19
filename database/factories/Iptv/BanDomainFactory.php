<?php

namespace Database\Factories\Iptv;

use Illuminate\Database\Eloquent\Factories\Factory;

class BanDomainFactory extends Factory
{
    public function definition(): array
    {
        return [
            'domain' => fake()->domainName(),
        ];
    }
}
