<?php

namespace Tests\Unit\Repository;

use App\Models\VideoFiles\VideoFile;
use App\Repositories\VideoFiles\VideoFileRepository;

class VideoFileRepositoryTest extends BaseRepository
{
    protected string $repositoryClass = VideoFileRepository::class;
    protected string $modelClass = VideoFile::class;

    protected function getFields(): array
    {
        return [
            'path' => 'path',
            'poster' => 'poster',
            'title' => 'title',
            'original_title' => 'original title',
            'kinopoisk_url' => 'url',
            'imbd' => 1,
            'kinopoisk' => 5,
            'description' => 'description',
            'is_active' => false,
            'show_start' => '2023-12-19 11:20',
            'show_end' => '2023-12-19 13:20',
            'year' => 2023,
            'country' => 'counrty',
            'director' => 'director',
            'actors' => 'actores',
        ];
    }
}
