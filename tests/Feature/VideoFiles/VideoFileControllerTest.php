<?php

namespace Tests\Feature\VideoFiles;

use App\Models\VideoFiles\VideoFile;
use Tests\Feature\BaseController;

class VideoFileControllerTest extends BaseController
{
    protected string $model = VideoFile::class;
    protected string $apiPath = 'videofile';

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
            'show_start' => '2023-12-19',
            'show_end' => '2023-12-19',
            'year' => 2023,
            'country' => 'counrty',
            'director' => 'director',
            'actors' => 'actores',
        ];
    }
}
