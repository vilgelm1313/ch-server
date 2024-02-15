<?php

namespace App\Http\Controllers\Api\Settings;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Settings\ServerRequest;
use App\Jobs\ServerSyncJob;
use App\Models\Settings\Server;
use App\Repositories\Settings\ServerRepository;
use Illuminate\Http\Request;

class ServerController extends BaseController
{
    protected array $syncTypes = ['channels', 'categories', 'countries', 'videoFiles'];
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
            'relation' => 'required|in:channels,categories,countries,videoFiles',
            'ids' => 'array|required',
        ]);

        $ids = $request->ids;
        $server->{$request->relation}()->syncWithPivotValues($ids, [
            'synced_at' => null,
        ]);

        return $this->success();
    }

    public function sync(Server $server, Request $request)
    {
        $this->validate($request, [
            'type' => 'required|in:' . implode(',', $this->syncTypes),
        ]);

        ServerSyncJob::dispatch($server, $request->type);

        return $this->success();
    }

    public function syncAll()
    {
        $servers = Server::where('is_active', 1)->get();
        foreach ($servers as $server) {
            foreach ($this->syncTypes as $type) {
                ServerSyncJob::dispatch($server, $type);
            }
        }

        return $this->success();
    }
}
