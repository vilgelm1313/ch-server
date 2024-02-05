<?php

namespace App\Http\Controllers\Api\Settings;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Settings\ServerRequest;
use App\Repositories\Settings\ServerRepository;

class ServerController extends BaseController
{
    protected function getRepositoryClass(): string
    {
        return ServerRepository::class;
    }

    public function getRequestClass(): string
    {
        return ServerRequest::class;
    }
}
