<?php

namespace Database\Seeders;

use App\Models\Settings\EpgSetting;
use Illuminate\Support\Str;

class EpgSettingsSeeder extends InitialDataSeeder
{
    public function processItem(array $item): void
    {
        $c = EpgSetting::where('name', $item['name'])->first();
        if (!$c) {
            $c = new EpgSetting();
        }
        $c->name = $item['name'];
        $c->prefix = strtolower(Str::before($item['name'], '-'));
        $c->url = $item['url'];
        $c->refresh_period = 1440;
        $c->save();
    }

    public function getFileName(): string
    {
        return 'epgsettings';
    }
}
