<?php

namespace Tests\Unit\Repository\Iptv;

use App\Models\Iptv\News;
use App\Repositories\Iptv\NewsRepository;
use Tests\Unit\Repository\BaseRepository;

class NewsRepositoryTest extends BaseRepository
{
    protected string $repositoryClass = NewsRepository::class;
    protected string $modelClass = News::class;

    protected function getFields(): array
    {
        return [
            'title' => 'test',
            'text' => '2123',
            'is_active' => false,
        ];
    }
}
