<?php

namespace App\Services\Server\Syncers;

use App\Models\Settings\Category;
use App\Models\Settings\Server;

class CountrySyncer implements ServerSyncerContract
{
    public function getData(Server $server): array
    {
        $countries = $server->categories()->where('is_active', true)->get();
        $data = [];
        /**
         * @var Category
         */
        foreach ($countries as $country) {
            $data[] = [
                'id' => $country->code,
                'name' => $country->name,
            ];
        }

        return $data;
    }

    public function getType(): string
    {
        return 'settings';
    }

    public function getName(): string
    {
        return 'country';
    }
}
