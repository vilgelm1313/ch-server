<?php

namespace App\Repositories\Iptv;

use App\Models\Iptv\BanIp;
use App\Repositories\BaseRepository;

class BanIpRepository extends BaseRepository
{
    protected function getClass(): string
    {
        return BanIp::class;
    }
}
