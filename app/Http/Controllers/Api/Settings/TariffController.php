<?php

namespace App\Http\Controllers\Api\Settings;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Settings\TariffRequest;
use App\Repositories\Settings\TariffRepository;

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
