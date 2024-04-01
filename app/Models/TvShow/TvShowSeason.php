<?php

namespace App\Models\TvShow;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TvShowSeason
 *
 * @property string $title
 * @property array $episodes
 * @property bool $is_active
 */
class TvShowSeason extends BaseModel
{
    use HasFactory;
    protected $fillable = [
        'title',
        'episodes',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'episodes' => 'array',
    ];
}
