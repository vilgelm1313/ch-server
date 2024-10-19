<?php

namespace Tests\Unit\Repository\Iptv;

use App\Models\Iptv\StreamServer;
use App\Repositories\Iptv\StreamServerRepository;
use Tests\Unit\Repository\BaseRepository;

class StreamServerRepositoryTest extends BaseRepository
{
    protected string $repositoryClass = StreamServerRepository::class;
    protected string $modelClass = StreamServer::class;

    protected function getFields(): array
    {
        return [
            'name' => 'test',
            'is_active' => true,
            'index' => 1,
            'address' => '127.0.0.1',
            'port' => 8080,
        ];
    }
}
