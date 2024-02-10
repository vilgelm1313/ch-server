<?php

namespace App\Models\Channels;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Channel
 *
 * @property string $name
 * @property string $comment
 * @property string $epg_key
 * @property string $logo
 * @property int $category_id
 * @property int $country_id
 * @property string $smartiptv
 * @property string $ssiptv
 * @property int $index
 * @property int $tariff_id
 * @property bool $is_test
 * @property string $url
 * @property int $dvr
 * @property bool $is_hevc
 * @property bool $is_active
 * @property bool $is_external
 */
class Channel extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'comment',
        'epg_key',
        'logo',
        'category_id',
        'country_id',
        'smartiptv',
        'ssiptv',
        'index',
        'tariff_id',
        'is_test',
        'url',
        'dvr',
        'is_hevc',
        'is_active',
        'is_external',
    ];
}
