<?php

namespace App\Repositories\Iptv;

use App\Models\Iptv\BanDomain;
use App\Repositories\BaseRepository;

class BanDomainRepository extends BaseRepository
{
    protected function getClass(): string
    {
        return BanDomain::class;
    }
}
