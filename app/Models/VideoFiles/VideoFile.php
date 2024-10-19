<?php

namespace App\Models\VideoFiles;

use App\Models\BaseModel;
use App\Models\Settings\Server;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class VideoFile
 *
 * @property string $path
 * @property string $poster
 * @property string $title
 * @property string $original_title
 * @property string $kinopoisk_url
 * @property float $imbd
 * @property float $kinopoisk
 * @property string $description
 * @property bool $is_active
 * @property date $show_start
 * @property date $show_end
 * @property int $year
 * @property string $country
 * @property string $director
 * @property string $actors
 * @property string $genres
 */
class VideoFile extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'path',
        'poster',
        'title',
        'original_title',
        'kinopoisk_url',
        'imbd',
        'kinopoisk',
        'description',
        'is_active',
        'show_start',
        'show_end',
        'year',
        'country',
        'director',
        'actors',
        'genres',
    ];

    public const SORT_FIELDS = [
        'views'
    ];

    const FILTERS = [
        'title' => ['type' => 'string'],
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'year' => 'string',
    ];

    public function servers()
    {
        return $this->belongsToMany(Server::class, 'video_file_server')
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
}
