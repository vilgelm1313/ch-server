<?php

namespace Tests\Unit\Repository;

use App\Models\User\User;
use App\Repositories\User\UserRepository;

class UserRepositoryTest extends BaseRepository
{
    protected string $repositoryClass = UserRepository::class;
    protected string $modelClass = User::class;

    protected function getFields(): array
    {
        return [
            'username' => 'test',
            'password' => '<PASSWORD>',
            'is_active' => false,
        ];
    }
}
