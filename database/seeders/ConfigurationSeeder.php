<?php

namespace Database\Seeders;

use App\Models\Settings\Configuration;
use Illuminate\Database\Seeder;

class ConfigurationSeeder extends Seeder
{
    public function run(): void
    {
        $configs = [
            'kinopoisk_api_key' => env('KINOPOISK_API_KEY'),
        ];

        foreach ($configs as $key => $value) {
            $c = Configuration::where('key', $key)->first();
            if (!$c) {
                $c = new Configuration();
                $c->key = $key;
            }
            $c->value = $value;
            $c->save();
        }
    }
}
