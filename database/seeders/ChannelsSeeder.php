<?php

namespace Database\Seeders;

use App\Models\Channels\Channel;

class ChannelsSeeder extends InitialDataSeeder
{
    public function processItem(array $item): void
    {
        /**
         * @var Channel $c
         */
        $c = Channel::find($item['id']);
        if (!$c) {
            $c = new Channel();
            $c->id = $item['id'];
        }
        $c->name = $item['name'];
        $c->epg_key = $item['epg'];
        $c->dvr = (int) $item['dvr'];
        $c->smartiptv = $item['smartiptv'];
        $c->is_active = true;
        $c->logo = 'https://plati.one/logo/' . $item['logo'];

        $c->save();

        $c->categories()->syncWithPivotValues(
            [$item['packet']],
            [
                'index' => $item['corder']
            ]
        );
    }

    public function getFileName(): string
    {
        return 'channels';
    }
}
