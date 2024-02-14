<?php

namespace App\Models\Settings;

use App\Models\BaseModel;
use App\Models\Channels\Channel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Category
 *
 * @property string $name
 * @property int $index
 * @property int $parent_id
 * @property bool $is_active
 * @property bool $is_parental_control
 */
class Category extends BaseModel
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
        'is_active',
        'is_parental_control',
    ];
    protected $casts = [
        'is_active' => 'boolean',
        'is_parental_control' => 'boolean',
    ];

    public function servers()
    {
        return $this->belongsToMany(Server::class, 'category_server')
            ->withPivot('synced_at')
            ->as('synced');
    }

    public function channels()
    {
        return $this->belongsToMany(Channel::class, 'category_channel')
            ->withPivot('index');
    }
}
