<?php

namespace App\Http\Controllers\Api\Channels;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Channels\ChannelRequest;
use App\Repositories\Channels\ChannelRepository;

class ChannelController extends BaseController
{
    protected function getRepositoryClass(): string
    {
        return ChannelRepository::class;
    }

    public function getRequestClass(): string
    {
        return ChannelRequest::class;
    }
}
