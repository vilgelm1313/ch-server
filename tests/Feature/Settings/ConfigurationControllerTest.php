<?php

namespace Tests\Feature\Settings;

use App\Models\Settings\Configuration;
use Tests\Feature\BaseController;

class ConfigurationControllerTest extends BaseController
{
    protected string $model = Configuration::class;
    protected string $apiPath = 'configuration';

    protected function getFields(): array
    {
        return [
            'key' => 'test',
            'value' => 'test',
        ];
    }
}
