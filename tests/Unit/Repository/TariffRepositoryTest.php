<?php

namespace Tests\Unit\Repository;

use App\Models\Settings\Tariff;
use App\Repositories\Settings\TariffRepository;

class TariffRepositoryTest extends BaseRepository
{
    protected string $repositoryClass = TariffRepository::class;
    protected string $modelClass = Tariff::class;

    protected function getFields(): array
    {
        return [
            'name' => 'test',
            'is_active' => false,
            'index' => 1,
            'key' => 'test',
        ];
    }
}
