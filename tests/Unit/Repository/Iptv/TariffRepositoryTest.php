<?php

namespace Tests\Unit\Repository\Iptv;

use App\Models\Iptv\Tariff;
use App\Models\Iptv\VideoServer;
use App\Repositories\Iptv\TariffRepository;
use Tests\Unit\Repository\BaseRepository;

class TariffRepositoryTest extends BaseRepository
{
    protected string $repositoryClass = TariffRepository::class;
    protected string $modelClass = Tariff::class;

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
