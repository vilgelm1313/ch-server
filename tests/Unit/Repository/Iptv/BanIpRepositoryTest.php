<?php

namespace Tests\Unit\Repository\Iptv;

use App\Models\Iptv\BanIp;
use App\Repositories\Iptv\BanIpRepository;
use Tests\Unit\Repository\BaseRepository;

class BanIpRepositoryTest extends BaseRepository
{
    protected string $repositoryClass = BanIpRepository::class;
    protected string $modelClass = BanIp::class;

    protected function getFields(): array
    {
        return [
            'ip' => 'test',
        ];
    }
}
