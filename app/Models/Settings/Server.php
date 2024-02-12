<?php

namespace App\Models\Settings;

use App\Models\BaseModel;
use App\Models\Channels\Channel;
use App\Models\VideoFiles\VideoFile;
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

    public function channels()
    {
        return $this->belongsToMany(Channel::class, 'channel_server')
            ->withPivot('synced_at')
            ->as('synced');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_server')
            ->withPivot('synced_at')
            ->as('synced');
    }

    public function tariffs()
    {
        return $this->belongsToMany(Tariff::class, 'server_tariff')
            ->withPivot('synced_at')
            ->as('synced');
    }

    public function countries()
    {
        return $this->belongsToMany(Country::class, 'country_server')
            ->withPivot('synced_at')
            ->as('synced');
    }

    public function videoFiles()
    {
        return $this->belongsToMany(VideoFile::class, 'video_file_server')
            ->withPivot('synced_at')
            ->as('synced');
    }
}
