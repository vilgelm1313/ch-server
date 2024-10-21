<?php

namespace Tests\Feature\Iptv;

use App\Models\Iptv\Dealer;
use App\Models\Iptv\VideoServer;
use Tests\Feature\BaseController;

class DealerControllerTest extends BaseController
{
    protected string $model = Dealer::class;
    protected string $apiPath = 'dealer';

    protected function getFields(): array
    {
        return [
            'email' => 'test@example.com',
            'password' => 'test',
            'password_confirmation' => 'test',
            'iptv_price' => 10,
            'playlist_price' => 5,
            'comment' => 'test',
            'is_active' => true,
            'video_server_id' => VideoServer::factory()->create()->id,
        ];
    }
}
