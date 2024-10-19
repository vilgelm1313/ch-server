<?php

namespace Tests\Feature\Iptv;

use App\Models\Iptv\VideoServer;
use Tests\Feature\BaseController;

class VideoServerControllerTest extends BaseController
{
    protected string $model = VideoServer::class;
    protected string $apiPath = 'videoserver';

    protected function getFields(): array
    {
        return [
            'name' => 'test',
            'is_active' => true,
            'session_timeout' => 10,
            'timezone' => 'UTC',
            'timeout' => 60,
            'mail_from' => 'example@example.com',
            'mail_host' => 'example.com',
            'mail_password' => 'password',
            'mail_user' => 'user',
            'epg_src' => 'http://example.com/epg',
            'logo_src' => 'http://example.com/logo',
            'is_maintenence' => false,
            'token_lifetime' => 3600,
            'mail_encryption' => true,
        ];
    }
}
