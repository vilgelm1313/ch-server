<?php

namespace App\Http\Controllers\Api\Settings;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Settings\CountryRequest;
use App\Repositories\Settings\CountryRepository;

class CountryController extends BaseController
{
    protected function getRepositoryClass(): string
    {
        return CountryRepository::class;
    }

    public function getRequestClass(): string
    {
        return CountryRequest::class;
    }
}
