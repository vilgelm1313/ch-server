<?php

namespace Tests\Unit\Repository;

use App\Models\Channels\Channel;
use App\Repositories\Channels\ChannelRepository;

class ChannelRepositoryTest extends BaseRepository
{
    protected string $repositoryClass = ChannelRepository::class;
    protected string $modelClass = Channel::class;

    protected function getFields(): array
    {
        return [
            'name' => 'name',
            'comment' => 'comment',
            'logo' => 'logo',
            'category_id' => 1,
            'country_id' => 1,
            'epg_id' => 1,
            'smartiptv' => 'smartiptv',
            'ssiptv' => 'ssiptv',
            'index' => 1,
            'tariff_id' => 1,
            'is_test' => true,
            'url' => 'url',
            'dvr' => 1,
            'is_hevc' => true,
            'is_active' => false,
            'is_external' => true,
        ];
    }
}
