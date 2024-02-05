<?php

namespace Database\Seeders;

use App\Models\Settings\Country;

class CountriesSeeder extends InitialDataSeeder
{
    public function processItem(array $item): void
    {
        $c = Country::where('code', $item['id'])->first();
        if (!$c) {
            $c = new Country();
            $c->code = $item['id'];
        }
        $c->name = $item['name'];
        $c->save();
    }

    public function getFileName(): string
    {
        return 'countries';
    }
}
