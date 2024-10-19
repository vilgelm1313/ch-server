<?php

namespace Tests\Feature\Iptv;

use App\Models\Iptv\BanIp;
use Tests\Feature\BaseController;

class BanIpControllerTest extends BaseController
{
    protected string $model = BanIp::class;
    protected string $apiPath = 'banip';

    protected function getFields(): array
    {
        return [
            'ip' => 'test',
        ];
    }
}
