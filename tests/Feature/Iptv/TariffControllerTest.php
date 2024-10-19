<?php

namespace Tests\Feature\Iptv;

use App\Models\Iptv\StreamServer;
use App\Models\Iptv\Tariff;
use App\Models\Iptv\VideoServer;
use Tests\Feature\BaseController;

class TariffControllerTest extends BaseController
{
    protected string $model = Tariff::class;
    protected string $apiPath = 'tariff';

    protected function getFields(): array
    {
        return [
            'name' => 'test',
            'is_active' => true,
            'price' => 100,
            'video_server_id' => VideoServer::factory()->create()->id,
        ];
    }
}
