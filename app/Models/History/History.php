<?php

namespace App\Models\History;

use App\Models\BaseModel;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class History
 *
 * @property int $user_id
 * @property string $ip
 * @property string $action
 */
class History extends BaseModel
{
    use HasFactory;

    public const FILTERS = [
        'user_username' => [
            'type' => 'string',
            'relationship' => 'user',
            'field' => 'username',
        ],
        'ip' => [
            'type' => 'string',
        ],
    ];

    protected $fillable = [
        'user_id',
        'ip',
        'action',
    ];
    protected $casts = [
        'action' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
