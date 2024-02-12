<?php

namespace App\Http\Controllers\Api\Settings;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Settings\ServerRequest;
use App\Models\Settings\Server;
use App\Repositories\Settings\ServerRepository;
use Illuminate\Http\Request;

class ServerController extends BaseController
{
    protected function getRepositoryClass(): string
    {
        return ServerRepository::class;
    }

    public function getRequestClass(): string
    {
        return ServerRequest::class;
    }

    public function addRelations(Request $request, Server $server)
    {
        $this->validate($request, [
            'relation' => 'required|in:channels,categories,tariffs,countries,videoFiles',
            'ids' => 'array|required',
        ]);

        $ids = $request->ids;
        $server->{$request->relation}()->syncWithPivotValues($ids, [
            'synced_at' => null,
        ]);

        return $this->success();
    }
}
