<?php

namespace Tests\Feature\Channels;

use App\Models\Channels\Channel;
use App\Models\Settings\Category;
use App\Models\Settings\Country;
use App\Models\Settings\Tariff;
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
            'category_id' => Category::factory()->create()->id,
            'country_id' => Country::factory()->create()->id,
            'epg_key' => 'test',
            'smartiptv' => 'smartiptv',
            'ssiptv' => 'ssiptv',
            'index' => 1,
            'tariff_id' => Tariff::factory()->create()->id,
            'is_test' => true,
            'url' => 'http://example.com',
            'dvr' => 1,
            'is_hevc' => true,
            'is_active' => false,
            'is_external' => true,
        ];
    }
}
