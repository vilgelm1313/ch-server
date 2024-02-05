<?php

namespace App\Models\Settings;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Tariff
 *
 * @property string $name
 * @property int $index
 * @property bool $is_active
 * @property string $key
 */
class Tariff extends BaseModel
{
    use HasFactory;

    public const FILTERS = [
        'name' => [
            'type' => 'string',
        ],
    ];

    protected $fillable = [
        'name',
        'index',
        'key',
        'is_active',
    ];
    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function servers()
    {
        return $this->belongsToMany(Server::class, 'server_tariff')
            ->withPivot('synced_at')
            ->as('synced');
    }
}
