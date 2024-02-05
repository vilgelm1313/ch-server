<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\User\UserRequest;
use App\Repositories\User\UserRepository;

class UserController extends BaseController
{
    protected function getRepositoryClass(): string
    {
        return UserRepository::class;
    }

    public function getRequestClass(): string
    {
        return UserRequest::class;
    }
}
