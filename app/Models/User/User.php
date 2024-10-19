<?php

namespace App\Models\User;

use App\Models\BaseModel;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 *
 * @property string $username
 * @property string $password
 * @property bool $is_active
 * @property bool $is_admin
 * @property string $comment
 */
class User extends BaseModel implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable;
    use Authorizable;
    use HasApiTokens;
    use HasFactory;

    public const FILTERS = [
        'username' => [
            'type' => 'string',
        ],
    ];

    protected $fillable = [
        'username',
        'is_active',
        'password',
        'comment',
        'is_admin',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'password' => 'hashed',
        'is_active' => 'boolean',
        'is_admin' => 'boolean',
    ];
}
