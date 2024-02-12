<?php

namespace App\Repositories\VideoFiles;

use App\Models\BaseModel;
use App\Models\VideoFiles\VideoFile;
use App\Repositories\BaseRepository;
use App\Repositories\Traits\SyncServers;

class VideoFileRepository extends BaseRepository
{
    use SyncServers;

    protected function getClass(): string
    {
        return VideoFile::class;
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

    public function all()
    {
        return $this->getQuery()
            ->where('is_active', true)
            ->orderBy('title')
            ->get();
    }
}
