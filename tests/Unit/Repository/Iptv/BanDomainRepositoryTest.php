<?php

namespace Tests\Unit\Repository\Iptv;

use App\Models\Iptv\BanDomain;
use App\Repositories\Iptv\BanDomainRepository;
use Tests\Unit\Repository\BaseRepository;

class BanDomainRepositoryTest extends BaseRepository
{
    protected string $repositoryClass = BanDomainRepository::class;
    protected string $modelClass = BanDomain::class;

    protected function getFields(): array
    {
        return [
            'domain' => 'test.com',
        ];
    }
}
