<?php

namespace App\Repositories\Iptv;

use App\Models\Iptv\StreamServer;
use App\Repositories\BaseRepository;

class StreamServerRepository extends BaseRepository
{
    protected function getClass(): string
    {
        return StreamServer::class;
    }
}
