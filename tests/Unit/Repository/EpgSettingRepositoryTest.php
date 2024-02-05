<?php

namespace Tests\Unit\Repository;

use App\Models\Settings\EpgSetting;
use App\Repositories\Settings\EpgSettingRepository;

class EpgSettingRepositoryTest extends BaseRepository
{
    protected string $repositoryClass = EpgSettingRepository::class;
    protected string $modelClass = EpgSetting::class;

    protected function getFields(): array
    {
        return [
            'name' => 'name',
            'url' => 'url',
            'is_active' => false,
            'refresh_period' => 1,
        ];
    }
}
