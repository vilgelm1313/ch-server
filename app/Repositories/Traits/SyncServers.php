<?php

namespace App\Repositories\Traits;

use App\Models\BaseModel;

trait SyncServers
{
    protected function syncServers(BaseModel $model, array $data): BaseModel
    {
        $ids = $data['servers'] ?? [];
        $ids = array_map(function ($servers) {
            return $servers['id'];
        }, $ids);

        $model->servers()->syncWithPivotValues($ids, [
            'synced_at' => null,
        ]);
        $model->load('servers');

        return $model;
    }
}
