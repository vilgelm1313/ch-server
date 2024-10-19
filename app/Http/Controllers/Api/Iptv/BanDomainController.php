<?php

namespace App\Http\Controllers\Api\Iptv;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Iptv\BanpDomainRequest;
use App\Repositories\Iptv\BanDomainRepository;

class BanDomainController extends BaseController
{
    protected function getRepositoryClass(): string
    {
        return BanDomainRepository::class;
    }

    public function getRequestClass(): string
    {
        return BanpDomainRequest::class;
    }
}
