<?php

namespace App\Services\Server\Syncers;

use App\Models\Settings\Server;

interface ServerSyncerContract
{
    public function getData(Server $server): array;
    public function getType(): string;
    public function getName(): string;
}
