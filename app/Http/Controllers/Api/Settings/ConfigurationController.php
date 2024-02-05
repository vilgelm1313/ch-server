<?php

namespace App\Http\Controllers\Api\Settings;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Settings\ConfigurationRequest;
use App\Repositories\Settings\ConfigurationRepository;

class ConfigurationController extends BaseController
{
    protected function getRepositoryClass(): string
    {
        return ConfigurationRepository::class;
    }

    public function getRequestClass(): string
    {
        return ConfigurationRequest::class;
    }
}
