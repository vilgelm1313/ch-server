<?php

namespace App\Services\Server\Syncers;

use App\Models\Settings\Server;

class ExternalChannelSyncer implements ServerSyncerContract
{
    public function getData(Server $server): array
    {
        $data = [];
        $channels = $server->channels()
            ->where('is_external', true)
            ->where('is_active', true)
            ->with('categories')
            ->get();
        $index = 1;
        foreach ($channels as $channel) {
            foreach ($channel->categories as $category) {
                $data[] = [
                    'id' => (string) $index++,
                    'name' => $channel->name,
                    'epg' => $channel->flussonic,
                    'packet' => $category->id,
                    'smartiptv' => $channel->smartiptv,
                    'epg' => $channel->sync_logo,
                    'corder' => $category->pivot->index,
                    'dvr' => (int) $channel->dvr,
                    'external' => 1,
                    'url' => $channel->url,
                ];
            }
        }

        return $data;
    }

    public function getType(): string
    {
        return 'external';
    }

    public function getName(): string
    {
        return 'channels';
    }
}
