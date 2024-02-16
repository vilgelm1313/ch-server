<?php

namespace App\Models\Channels;

use App\Models\BaseModel;
use App\Models\Settings\Category;
use App\Models\Settings\Country;
use App\Models\Settings\EpgSetting;
use App\Models\Settings\Server;
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

    public const FILTERS = [
        'name' => [
            'type' => 'string',
        ],
        'epg_key' => [
            'type' => 'string',
        ],
        'category_name' => [
            'type' => 'string',
            'relationship' => 'category',
            'field' => 'name',
        ],
        'tariff_name' => [
            'type' => 'string',
            'relationship' => 'category',
            'field' => 'name',
        ],
        'is_active' => [
            'type' => 'equal',
        ],
    ];

    protected $fillable = [
        'name',
        'comment',
        'logo',
        'country_id',
        'smartiptv',
        'url',
        'dvr',
        'is_active',
        'is_external',
        'epg_setting_id',
    ];
    protected $casts = [
        'is_active' => 'boolean',
        'is_external' => 'boolean',
    ];

    public function servers()
    {
        return $this->belongsToMany(Server::class, 'channel_server')
            ->withPivot('synced_at')
            ->as('synced');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_channel')
            ->withPivot('index');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function epgSettings()
    {
        return $this->belongsToMany(EpgSetting::class, 'channels_epg_settings');
    }

    public function epgSetting()
    {
        return $this->belongsTo(EpgSetting::class);
    }
}
