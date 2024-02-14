<?php

namespace Database\Seeders;

use App\Models\Channels\Channel;

class ExternalChannelSeeder extends InitialDataSeeder
{
    public function processItem(array $item): void
    {
        /**
         * @var Channel $c
         */
        $c = Channel::where('name', $item['name'])
            ->where('is_external', true)
            ->first();
        if (!$c) {
            $c = new Channel();
        }
        $c->name = $item['name'];
        $c->index = $item['corder'];
        $c->epg_key = $item['epg'];
        $c->category_id = $item['packet'];
        $c->smartiptv = $item['smartiptv'];
        $c->ssiptv = $item['ssiptv'];
        $c->is_test = (int) $item['test'];
        $c->is_hevc = (int) $item['hevc'];
        $c->is_active = true;
        $c->is_external = true;
        $c->tariff_id = (int) $item['level'] + 1;
        $c->url = $item['url'];
        $c->logo = 'https://plati.one/logo/' . $item['logo'];

        $c->save();
    }

    public function getFileName(): string
    {
        return 'external';
    }
}
