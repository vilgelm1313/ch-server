<?php

namespace App\Models\Iptv;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Dealer
 *
 * @property string $email
 * @property string $password
 * @property float $balance
 * @property float $iptv_price
 * @property float $playlist_price
 * @property string $comment
 * @property boolean $is_active
 * @property int $video_server_id
 */
class Dealer extends BaseModel
{
    use HasFactory;
    public const FILTERS = [
        'email' => [
            'type' => 'string',
            'field' => 'email',
        ]
    ];

    protected $fillable = [
        'email',
        'password',
        'iptv_price',
        'playlist_price',
        'comment',
        'is_active',
        'video_server_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function videoServer(): BelongsTo
    {
        return $this->belongsTo(VideoServer::class);
    }

    public function password(): Attribute
    {
        return new Attribute(
            set: fn ($value) => bcrypt($value),
        );
    }
}
