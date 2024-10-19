<?php

namespace App\Http\Controllers\Api\Iptv;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Iptv\BanpIpRequest;
use App\Repositories\Iptv\BanIpRepository;

class BanIpController extends BaseController
{
    protected function getRepositoryClass(): string
    {
        return BanIpRepository::class;
    }

    public function getRequestClass(): string
    {
        return BanpIpRequest::class;
    }
}
