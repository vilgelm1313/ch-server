<?php

namespace App\Http\Controllers\Api\Iptv;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Iptv\VideoServerRequest;
use App\Repositories\Iptv\VideoServerRepository;

class VideoServerController extends BaseController
{
    protected function getRepositoryClass(): string
    {
        return VideoServerRepository::class;
    }

    public function getRequestClass(): string
    {
        return VideoServerRequest::class;
    }
}
