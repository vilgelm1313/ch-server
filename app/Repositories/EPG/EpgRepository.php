<?php

namespace App\Repositories\EPG;

use App\Models\Channels\Channel;
use App\Models\EPG\Epg;
use App\Repositories\BaseRepository;

class EpgRepository extends BaseRepository
{
    protected function getClass(): string
    {
        return Epg::class;
    }

    public function channelEpg(Channel $channel, ?int $perPage = 100, ?array $filters = [])
    {
        $builder = $this->getQuery();
        $builder->where('channel_id', $channel->id);

        return $this->paginate($builder, $perPage, $filters);
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
