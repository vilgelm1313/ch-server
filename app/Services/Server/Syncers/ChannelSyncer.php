<?php

namespace App\Services\Server\Syncers;

use App\Models\Channels\Channel;
use App\Models\Settings\Server;

class ChannelSyncer implements ServerSyncerContract
{
    public function getData(Server $server): array
    {
        $channels = $server->channels()
            ->where('is_external', false)
            ->where('is_active', true)
            ->with('categories')
            ->get();

        $data = [];
        /**
         * @var Channel
         */
        $index = 1;
        foreach ($channels as $channel) {
            foreach ($channel->categories as $category) {
                
                $data[] = [
                    'id' => (string) $index++,
                    'name' => $channel->name,
                    'epg' => $channel->epg_key,
                    'packet' => $category->id,
                    'smartiptv' => $channel->smartiptv,
                    'logo' => $channel->sync_logo,
                    'corder' => $category->pivot->index,
                    'dvr' => (int) $channel->dvr,
                ];
            }
        }

        return $data;
    }

    public function getType(): string
    {
        return 'internal';
    }

    public function getName(): string
    {
        return 'channels';
    }
}
