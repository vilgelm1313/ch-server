<?php

namespace App\Services\Server\Syncers;

use App\Models\Settings\Server;
use App\Models\VideoFiles\VideoFile;
use Carbon\Carbon;
use Illuminate\Support\Str;

class VideofileSyncer implements ServerSyncerContract
{
    public function getData(Server $server): array
    {
        $categories = $server->videoFiles()->where('is_active', true)->get();

        $data = [];
        /**
         * @var VideoFile $videoFile
         */
        foreach ($categories as $videoFile) {
            $filename = Str::afterLast('/', $videoFile->path);
            $path = Str::beforeLast('/', $videoFile->path);
            $subtitles = [];
            if ($videoFile->imbd) {
                $subtitles[] = 'IMBD: '. $videoFile->imbd;
            }
            if ($videoFile->kinopoisk) {
                $subtitles[] = 'Kinopoisk: '. $videoFile->kinopoisk;
            }
            if ($videoFile->year) {
                $subtitles[] = $videoFile->year . '.';
            }
            $subtitle = implode(' | ', $subtitles);
            if ($videoFile->country) {
                $subtitle .= ' ' . $videoFile->country . '.';
            }
            if ($videoFile->genres) {
                $subtitle .= ' ' . $videoFile->genres . '.';
            }
            if ($videoFile->director) {
                $subtitle .= ' Режиссер: ' . $videoFile->director . '.';
            }
            if ($videoFile->actors) {
                $subtitle .= ' В ролях: ' . $videoFile->genres . '.';
            }
            $data[] = [
                'filename' => $filename,
                'path' => $path,
                'poster' => $videoFile->poster,
                'title' => $videoFile->title . $videoFile->original_title ? (' | '. $videoFile->original_title) : '',
                'sub-title' => $subtitle,
                'description' => $videoFile->description,
                'time-to-die' => Carbon::parse($videoFile->end)->timestamp,
                'active' => 1,
            ];
        }

        return $data;
    }

    public function getType(): string
    {
        return 'file';
    }

    public function getName(): string
    {
        return '';
    }
}
