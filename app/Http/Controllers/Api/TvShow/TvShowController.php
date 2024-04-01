<?php

namespace App\Http\Controllers\Api\TvShow;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\TvShow\TvShowRequest;
use App\Repositories\TvShow\TvShowRepository;

class TvShowController extends BaseController
{
    protected function getRepositoryClass(): string
    {
        return TvShowRepository::class;
    }

    public function getRequestClass(): string
    {
        return TvShowRequest::class;
    }
}
