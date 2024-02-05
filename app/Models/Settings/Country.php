<?php

namespace App\Models\Settings;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Country
 *
 * @property string $name
 * @property string $code
 * @property bool $is_active
 * @property int $index
 */
class Country extends BaseModel
{
    use HasFactory;

    public const FILTERS = [
        'name' => [
            'type' => 'string',
        ],
        'code' => [
            'type' => 'string',
        ],
    ];

    protected $fillable = [
        'name',
        'code',
        'is_active',
        'index',
    ];
    protected $casts = [
        'is_active' => 'boolean',
    ];
}
