<?php

namespace Database\Seeders;

use App\Models\Settings\Tariff;

class TariffsSeeder extends InitialDataSeeder
{
    public function processItem(array $item): void
    {
        $c = Tariff::where('key', $item['key'])->first();
        if (!$c) {
            $c = new Tariff();
        }
        $c->name = $item['name'];
        $c->key = $item['key'];
        $c->save();
    }

    public function getFileName(): string
    {
        return 'tariffs';
    }
}
