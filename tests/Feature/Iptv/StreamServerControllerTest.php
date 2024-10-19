<?php

namespace Tests\Feature\Iptv;

use App\Models\Iptv\StreamServer;
use App\Models\Iptv\VideoServer;
use Tests\Feature\BaseController;

class StreamServerControllerTest extends BaseController
{
    protected string $model = StreamServer::class;
    protected string $apiPath = 'streamserver';

    protected function getFields(): array
    {
        return [
            'name' => 'test',
            'is_active' => true,
            'index' => 1,
            'address' => '127.0.0.1',
            'port' => 8080,
        ];
    }
}
