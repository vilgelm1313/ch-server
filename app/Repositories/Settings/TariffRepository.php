<?php

namespace App\Repositories\Settings;

use App\Models\BaseModel;
use App\Models\Settings\Tariff;
use App\Repositories\BaseRepository;
use App\Repositories\Traits\SyncServers;

class TariffRepository extends BaseRepository
{
    use SyncServers;

    protected function getClass(): string
    {
        return Tariff::class;
    }

    protected function getWith(): array
    {
        return [
            'servers',
        ];
    }

    protected function afterSave(BaseModel $model, array $data): BaseModel
    {
        return $this->syncServers($model, $data);
    }
}
