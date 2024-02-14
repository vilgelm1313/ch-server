<?php

namespace App\Repositories\Settings;

use App\Models\BaseModel;
use App\Models\Settings\Category;
use App\Repositories\BaseRepository;
use App\Repositories\Traits\SyncServers;

class CategoryRepository extends BaseRepository
{
    use SyncServers;

    protected function getClass(): string
    {
        return Category::class;
    }

    protected function getWith(): array
    {
        return [
            'servers',
            'channels',
        ];
    }

    protected function getDefaultOrderColumn(): string
    {
        return 'index';
    }

    protected function afterSave(BaseModel $model, array $data): BaseModel
    {
        return $this->syncServers($model, $data);
    }
}
