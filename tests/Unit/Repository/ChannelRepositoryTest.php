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
            'epg_key' => 'test',
            'smartiptv' => 'smartiptv',
            'url' => 'url',
            'dvr' => 1,
            'is_active' => false,
            'is_external' => true,
        ];
    }
}
