<?php

namespace App\Models\Settings;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Server
 *
 * @property string $name
 * @property string $address
 * @property bool $is_active
 */
class Server extends BaseModel
{
    use HasFactory;

    const FILTERS = [
        'name' => ['type' => 'string'],
        'address' => ['type' => 'string'],
        'is_active' => ['type' => 'equal'],
    ];

    protected $fillable = [
        'name',
        'address',
        'is_active',
    ];
    protected $casts = [
        'is_active' => 'boolean',
    ];
}
