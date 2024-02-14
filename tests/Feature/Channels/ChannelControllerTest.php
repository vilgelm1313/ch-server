<?php

namespace Tests\Feature\Channels;

use App\Models\Channels\Channel;
use Tests\Feature\BaseController;

class ChannelControllerTest extends BaseController
{
    protected string $model = Channel::class;
    protected string $apiPath = 'channel';

    protected function getFields(): array
    {
        return [
            'name' => 'name',
            'comment' => 'comment',
            'logo' => 'logo',
            //'epg_key' => 'test',
            'smartiptv' => 'smartiptv',
            'url' => 'http://example.com',
            'dvr' => 1,
            'is_active' => false,
            'is_external' => true,
        ];
    }
}
