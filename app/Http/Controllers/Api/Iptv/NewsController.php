<?php

namespace App\Http\Controllers\Api\Iptv;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Iptv\NewsRequest;
use App\Repositories\Iptv\NewsRepository;

class NewsController extends BaseController
{
    protected function getRepositoryClass(): string
    {
        return NewsRepository::class;
    }

    public function getRequestClass(): string
    {
        return NewsRequest::class;
    }
}
