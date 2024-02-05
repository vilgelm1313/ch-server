<?php

namespace App\Repositories\Channels;

use App\Models\Channels\Channel;
use App\Repositories\BaseRepository;

class ChannelRepository extends BaseRepository
{
    protected function getClass(): string
    {
        return Channel::class;
    }
}
