<?php

namespace App\Repositories\Iptv;

use App\Models\Iptv\Tariff;
use App\Repositories\BaseRepository;

class TariffRepository extends BaseRepository
{
    protected function getClass(): string
    {
        return Tariff::class;
    }
}
