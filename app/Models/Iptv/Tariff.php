<?php

namespace App\Models\Iptv;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Tariff
 *
 * @property string $name
 * @property float $price
 * @property bool $is_active
 */
class Tariff extends BaseModel
{
    use HasFactory;

    public const FILTERS = [
        'video_server_id' => [
            'type' => 'list',
            'field' => 'video_server_id'
        ],
        'name' => [
            'type' => 'string',
            'field' => 'name',
        ]
    ];
    protected $fillable = [
        'name',
        'is_active',
        'price',
        'video_server_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function videoServer(): BelongsTo
    {
        return $this->belongsTo(VideoServer::class);
    }
}
