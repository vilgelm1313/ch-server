<?php

namespace Database\Seeders;

use App\Models\Settings\EpgSetting;

class EpgSettingsSeeder extends InitialDataSeeder
{
    public function processItem(array $item): void
    {
        $c = EpgSetting::where('name', $item['name'])->first();
        if (!$c) {
            $c = new EpgSetting();
        }
        $c->name = $item['name'];
        $c->prefix = $item['name'];
        $c->url = $item['url'];
        $c->refresh_period = $item['refresh_period'];
        $c->save();
    }

    public function getFileName(): string
    {
        return 'epgsettings';
    }
}
