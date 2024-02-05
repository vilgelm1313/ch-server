<?php

namespace Tests\Unit\Repository;

use App\Models\Settings\Server;
use App\Repositories\Settings\ServerRepository;

class ServerRepositoryTest extends BaseRepository
{
    protected string $repositoryClass = ServerRepository::class;
    protected string $modelClass = Server::class;

    protected function getFields(): array
    {
        return [
            'name' => 'test',
            'address' => 'address',
            'is_active' => false,
        ];
    }
}
