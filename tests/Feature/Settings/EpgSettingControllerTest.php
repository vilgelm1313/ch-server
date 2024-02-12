<?php

namespace Tests\Feature\Settings;

use App\Models\Settings\EpgSetting;
use Tests\Feature\BaseController;

class EpgSettingControllerTest extends BaseController
{
    protected string $model = EpgSetting::class;
    protected string $apiPath = 'epgsetting';

    protected function getFields(): array
    {
        return [
            'name' => 'test',
            'url' => 'test',
            'is_active' => true,
            'prefix' => 'test',
            'refresh_period' => 10,
        ];
    }
}
