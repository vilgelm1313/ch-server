<?php

namespace Tests\Unit\Repository;

use App\Models\History\History;
use App\Repositories\History\HistoryRepository;

class HistoryRepositoryTest extends BaseRepository
{
    protected string $repositoryClass = HistoryRepository::class;
    protected string $modelClass = History::class;

    protected function getFields(): array
    {
        return [
            'user_id' => 1,
            'ip' => 'ip',
            'action' => 'action',
        ];
    }
}
