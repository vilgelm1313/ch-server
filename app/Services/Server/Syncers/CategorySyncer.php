<?php

namespace App\Services\Server\Syncers;

use App\Models\Settings\Server;

class CategorySyncer implements ServerSyncerContract
{
    public function getData(Server $server): array
    {
        $categories = $server->categories()->where('is_active', true)->get();
        $data = [];
        /**
         * @var Country
         */
        foreach ($categories as $category) {
            $data[] = [
                'id' => $category->id,
                'name' => $category->name,
                'order' => $category->index,
                'parent' => (int) $category->is_parental_control,
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
        return 'packets';
    }
}
