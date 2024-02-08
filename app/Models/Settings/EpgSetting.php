<?php

namespace App\Models\Settings;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class EpgSetting
 *
 * @property string $name
 * @property string $url
 * @property bool $is_active
 * @property int $refresh_period
 * @property bool $processing
 * @property string $prefix
 * @property bool $has_error
 */
class EpgSetting extends BaseModel
{
    use HasFactory;

    public const FILTERS = [
        'name' => [
            'type' => 'string',
        ],
        'url' => [
            'type' => 'string',
        ],
        'has_error' => [
            'type' => 'string',
            'field' => 'error',
        ],
    ];

    protected $fillable = [
        'name',
        'url',
        'is_active',
        'refresh_period',
    ];
    protected $casts = [
        'is_active' => 'boolean',
        'processing' => 'boolean',
        'has_error' => 'boolean',
    ];
}
