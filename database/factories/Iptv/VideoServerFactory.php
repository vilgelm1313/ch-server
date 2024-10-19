<?php

namespace Database\Factories\Iptv;

use Illuminate\Database\Eloquent\Factories\Factory;

class VideoServerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name,
            'is_active' => true,
            'session_timeout' => 300,
            'timezone' => 'Europe/Paris',
            'timeout' => 60,
            'mail_from' => 'noreply@example.com',
            'mail_host' => 'smtp.example.com',
            'mail_password' => 'password',
            'mail_user' => 'user',
            'epg_src' => 'https://example.com/epg.xml',
            'logo_src' => 'https://example.com/logo.png',
            'is_maintenence' => false,
            'token_lifetime' => 3600,
            'mail_encryption' => true,
        ];
    }
}
