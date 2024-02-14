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
        $c->epg_key = $item['epg'];
        $c->smartiptv = $item['smartiptv'];
        $c->is_active = true;
        $c->is_external = true;
        $c->url = $item['url'];
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
        return 'external';
    }
}
