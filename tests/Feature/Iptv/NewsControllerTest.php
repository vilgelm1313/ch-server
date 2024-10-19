<?php

namespace Tests\Feature\Iptv;

use App\Models\Iptv\News;
use Tests\Feature\BaseController;

class NewsControllerTest extends BaseController
{
    protected string $model = News::class;
    protected string $apiPath = 'news';

    protected function getFields(): array
    {
        return [
            'title' => 'test',
            'is_active' => false,
            'text' => '1',
        ];
    }
}
