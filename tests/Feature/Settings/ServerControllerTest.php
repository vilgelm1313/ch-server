<?php

namespace Tests\Feature\Settings;

use App\Models\Settings\Server;
use Tests\Feature\BaseController;

class ServerControllerTest extends BaseController
{
    protected string $model = Server::class;
    protected string $apiPath = 'server';

    protected function getFields(): array
    {
        return [
            'name' => 'test',
            'address' => 'address',
            'is_active' => false,
        ];
    }
}
