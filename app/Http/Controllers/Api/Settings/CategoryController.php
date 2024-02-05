<?php

namespace App\Http\Controllers\Api\Settings;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Settings\CategoryRequest;
use App\Repositories\Settings\CategoryRepository;

class CategoryController extends BaseController
{
    protected function getRepositoryClass(): string
    {
        return CategoryRepository::class;
    }

    public function getRequestClass(): string
    {
        return CategoryRequest::class;
    }
}
