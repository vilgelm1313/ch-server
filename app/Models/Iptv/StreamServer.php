<?php

namespace App\Models\Iptv;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Tariff
 *
 * @property string $name
 * @property int $port
 * @property bool $is_active
 * @property string $address
 * @property int $index
 */
class StreamServer extends BaseModel
{
    use HasFactory;
    protected $fillable = [
        'name',
        'is_active',
        'index',
        'address',
        'port',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
