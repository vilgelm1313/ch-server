<?php

namespace App\Models\Channels;

use App\Models\BaseModel;
use App\Models\Settings\Category;
use App\Models\Settings\Country;
use App\Models\Settings\Server;
use App\Models\Settings\Tariff;
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
    ];

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

    protected $casts = [
        'is_active' => 'boolean',
        'year' => 'string',
        'is_hevc' => 'boolean',
        'is_external' => 'boolean',
        'is_test' => 'boolean',
    ];

    public function servers()
    {
        return $this->belongsToMany(Server::class, 'channel_server')
            ->withPivot('synced_at')
            ->as('synced');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function tariff()
    {
        return $this->belongsTo(Tariff::class);
    }
}
