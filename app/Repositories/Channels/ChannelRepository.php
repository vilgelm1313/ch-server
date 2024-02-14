<?php

namespace App\Repositories\Channels;

use App\Models\BaseModel;
use App\Models\Channels\Channel;
use App\Repositories\BaseRepository;
use App\Repositories\Traits\SyncServers;

class ChannelRepository extends BaseRepository
{
    use SyncServers;

    protected function getClass(): string
    {
        return Channel::class;
    }

    protected function getWith(): array
    {
        return [
            'servers',
            'country',
            'categories',
        ];
    }

    protected function afterSave(BaseModel $model, array $data): BaseModel
    {
        $model = $this->syncServers($model, $data);

        $ids = $data['categories'] ?? [];
        $ids = array_map(function ($category) {
            return $category['id'];
        }, $ids);

        $model->categories()->sync($ids);
        $model->load('categories');

        return $model;
    }
}
