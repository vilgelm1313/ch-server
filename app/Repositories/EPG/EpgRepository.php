<?php

namespace App\Repositories\EPG;

use App\Models\EPG\Epg;
use App\Repositories\BaseRepository;

class EpgRepository extends BaseRepository
{
    protected function getClass(): string
    {
        return Epg::class;
    }

    protected function getWith(): array
    {
        return [
            'channel',
            'epgSetting',
        ];
    }

    public function getDefaultOrderColumn(): string
    {
        return 'start';
    }
}
