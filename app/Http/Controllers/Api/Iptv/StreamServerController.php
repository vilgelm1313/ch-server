<?php

namespace App\Http\Controllers\Api\Iptv;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Iptv\StreamServerRequest;
use App\Repositories\Iptv\StreamServerRepository;

class StreamServerController extends BaseController
{
    protected function getRepositoryClass(): string
    {
        return StreamServerRepository::class;
    }

    public function getRequestClass(): string
    {
        return StreamServerRequest::class;
    }
}
