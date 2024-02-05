<?php

namespace App\Repositories\User;

use App\Models\User\User;
use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository
{
    protected function getClass(): string
    {
        return User::class;
    }
}
