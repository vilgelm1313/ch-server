<?php

namespace Tests\Unit\Repository;

use App\Models\Settings\Configuration;
use App\Repositories\Settings\ConfigurationRepository;

class ConfigurationRepositoryTest extends BaseRepository
{
    protected string $repositoryClass = ConfigurationRepository::class;
    protected string $modelClass = Configuration::class;

    protected function getFields(): array
    {
        return [
            'key' => 'name',
            'value' => 'address',
        ];
    }
}
