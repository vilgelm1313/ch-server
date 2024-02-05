<?php

namespace App\Http\Controllers\Api\Epg;

use App\Http\Controllers\Api\BaseController;
use App\Repositories\EPG\EpgRepository;

class EpgController extends BaseController
{
    protected function getRepositoryClass(): string
    {
        return EpgRepository::class;
    }

    public function getRequestClass(): string
    {
        return '';
    }
}
