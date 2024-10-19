<?php

namespace App\Repositories\Iptv;

use App\Models\Iptv\VideoServer;
use App\Repositories\BaseRepository;

class VideoServerRepository extends BaseRepository
{
    protected function getClass(): string
    {
        return VideoServer::class;
    }
}
