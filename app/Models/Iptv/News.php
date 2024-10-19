<?php

namespace App\Models\Iptv;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class News
 *
 * @property string $title
 * @property string $text
 * @property bool $is_active
 */
class News extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'title',
        'text',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
