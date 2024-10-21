<?php

namespace Tests\Unit\Repository\Iptv;

use App\Models\Iptv\Dealer;
use App\Models\Iptv\VideoServer;
use App\Repositories\Iptv\DealerRepository;
use Tests\Unit\Repository\BaseRepository;

class DealerRepositoryTest extends BaseRepository
{
    protected string $repositoryClass = DealerRepository::class;
    protected string $modelClass = Dealer::class;

    protected function getFields(): array
    {
        return [
            'email' => 'test@example.com',
            'password' => 'test',
            'balance' => 0,
            'iptv_price' => 10,
            'playlist_price' => 5,
            'comment' => 'test',
            'is_active' => true,
            'video_server_id' => VideoServer::factory()->create()->id,
        ];
    }
}
