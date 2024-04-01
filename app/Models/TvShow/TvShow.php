<?php

namespace App\Models\TvShow;

use App\Models\BaseModel;
use App\Models\Settings\Server;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TvShow
 *
 * @property string $title
 * @property string $original_title
 * @property string $comment
 * @property string $poster
 * @property bool $is_active
 * @property date $show_start
 * @property date $show_end
 * @property TvShowSeason[] $seasons
 */
class TvShow extends BaseModel
{
    use HasFactory;
    protected $fillable = [
        'title',
        'original_title',
        'comment',
        'poster',
        'show_start',
        'show_end',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function servers()
    {
        return $this->belongsToMany(Server::class, 'tv_show_server')
            ->withPivot('synced_at')
            ->as('synced');
    }


    public function syncLogo(): Attribute
    {
        $logo = str_replace('https://plati.one/logo/', '', $this->poster ?? '');
        $logo = str_replace('/api/file/get?path=', '', $logo ?? '');
        $logo = str_replace('public/', '', $logo ?? '');

        return new Attribute(fn () => $logo);
    }

    public function seasons()
    {
        return $this->hasMany(TvShowSeason::class);
    }
}
