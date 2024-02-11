<?php

namespace Database\Seeders;

use App\Models\Channels\Channel;
use App\Models\Settings\Category;
use App\Models\Settings\Tariff;

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
        $c->index = $item['corder'];
        $c->epg_key = $item['epg'];
        $c->category_id = $item['packet'] + 1;
        $c->dvr = (int) $item['dvr'];
        $c->smartiptv = $item['smartiptv'];
        $c->ssiptv = $item['ssiptv'];
        $c->is_test = (int) $item['test'];
        $c->is_hevc = (int) $item['hevc'];
        $c->is_active = true;
        $c->tariff_id = $item['level'] + 1;
        $c->logo = 'https://plati.one/logo/' . $item['logo'];
        
        $c->save();
    }

    public function getFileName(): string
    {
        return 'channels';
    }
}
