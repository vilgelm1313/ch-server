<?php

namespace App\Repositories\Settings;

use App\Models\Settings\Configuration;
use App\Repositories\BaseRepository;

class ConfigurationRepository extends BaseRepository
{
    protected function getClass(): string
    {
        return Configuration::class;
    }

    public function getValueByKey(string $key): ?string
    {
        /**
         * @var Configuration
         */
        $config = Configuration::where('key', $key)->first();
        if ($config) {
            return $config->value;
        }

        return null;
    }
}
