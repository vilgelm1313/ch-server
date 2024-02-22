<?php

namespace Database\Seeders;

use App\Models\Channels\Channel;

class OldEpgSeederSeeder extends InitialDataSeeder
{
    public function processItem(array $item): void
    {
        /**
         * @var Channel $c
         */
        $c = Channel::find($item['id']);
        if (!$c) {
            $c = Channel::where('name', $item['name'])->first();           
        }
        if (!$c) {
            return;
        }
        $c->old_epg_key = $item['epg'];
        $c->save();
    }

    public function getFileName(): string
    {
        return 'channels';
    }
}
