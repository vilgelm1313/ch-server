<?php

namespace App\Repositories\Iptv;

use App\Models\Iptv\News;
use App\Repositories\BaseRepository;

class NewsRepository extends BaseRepository
{
    protected function getClass(): string
    {
        return News::class;
    }
}
