<?php

namespace App\Repositories\Settings;

use App\Models\BaseModel;
use App\Models\Settings\Server;
use App\Repositories\BaseRepository;

class ServerRepository extends BaseRepository
{
    protected function getClass(): string
    {
        return Server::class;
    }

    public function show(int $id): BaseModel
    {
        $server = parent::show($id);
        $server->load([
            'channels',
            'countries',
            'tariffs',
            'categories',
            'videoFiles'
        ]);

        return $server;
    }
}
