<?php

namespace App\Repositories\Settings;

use App\Models\Settings\Server;
use App\Repositories\BaseRepository;

class ServerRepository extends BaseRepository
{
    protected function getClass(): string
    {
        return Server::class;
    }
}
