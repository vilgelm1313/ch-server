<?php

namespace App\Repositories\History;

use App\Models\History\History;
use App\Repositories\BaseRepository;

class HistoryRepository extends BaseRepository
{
    protected function getClass(): string
    {
        return History::class;
    }

    public function getWith(): array
    {
        return [
            'user',
        ];
    }

    public function getDefaultOrderColumn(): string
    {
        return 'id';
    }

    public function getDefaultOrderDirection(): string
    {
        return 'desc';
    }
}
