<?php

namespace App\Models\EPG;

use App\Models\BaseModel;
use App\Models\Channels\Channel;
use App\Models\Settings\EpgSetting;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Epg
 *
 * @property date $start
 * @property date $end
 * @property string $title
 * @property string $sub_title
 * @property string $description
 * @property string $language
 * @property int $epg_setting_id
 * @property int $channel_id
 * @property Channel $channel
 * @property EpgSetting $epgSetting
 */
class Epg extends BaseModel
{
    use HasFactory;

    public const FILTERS = [
        'channel_name' => [
            'type' => 'string',
            'relationship' => 'channel',
            'field' => 'name',
        ],
        'epg_setting_name' => [
            'type' => 'string',
            'relationship' => 'epgSetting',
            'field' => 'name',
        ],
    ];

    protected $fillable = [
        'start',
        'end',
        'title',
        'sub_title',
        'description',
        'language',
        'epg_setting_id',
    ];

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function epgSetting()
    {
        return $this->belongsTo(EpgSetting::class);
    }
}
