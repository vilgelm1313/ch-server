<?php

namespace Tests\Unit\Repository;

use App\Models\Settings\Country;
use App\Repositories\Settings\CountryRepository;

class CountryRepositoryTest extends BaseRepository
{
    protected string $repositoryClass = CountryRepository::class;
    protected string $modelClass = Country::class;

    protected function getFields(): array
    {
        return [
            'name' => 'test',
            'code' => '2',
            'is_active' => false,
            'index' => 3,
        ];
    }
}
