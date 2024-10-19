<?php

namespace App\Http\Controllers\Api\Iptv;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Iptv\TariffRequest;
use App\Repositories\Iptv\TariffRepository;

class TariffController extends BaseController
{
    protected function getRepositoryClass(): string
    {
        return TariffRepository::class;
    }

    public function getRequestClass(): string
    {
        return TariffRequest::class;
    }
}
