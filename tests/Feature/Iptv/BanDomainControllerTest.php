<?php

namespace Tests\Feature\Iptv;

use App\Models\Iptv\BanDomain;
use Tests\Feature\BaseController;

class BanDomainControllerTest extends BaseController
{
    protected string $model = BanDomain::class;
    protected string $apiPath = 'bandomain';

    protected function getFields(): array
    {
        return [
            'domain' => 'test',
        ];
    }
}
