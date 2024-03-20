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
        $files = $server->videoFiles()->where('is_active', true)
            ->orderBy('show_end', 'desc')
            ->get();

        $data = [];
        /**
         * @var VideoFile $videoFile
         */
        foreach ($files as $videoFile) {
            $filename = Str::afterLast($videoFile->path, '/');
            $path = Str::beforeLast($videoFile->path, '/');
            if (strpos($filename, '/') === false) {
                $path = 'video';
            }
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
                $subtitle .= ' В ролях: ' . $videoFile->actors . '.';
            }
            $title = [];
            if ($videoFile->title) {
                $title[] = $videoFile->title;
            }
            if ($videoFile->original_title) {
                $title[] = $videoFile->original_title;
            }
            $data[$filename] = [
                'filename' => $filename,
                'path' => $path,
                'poster' => 'plati.one/logo' . $videoFile->poster,
                'title' => implode(' | ', $title),
                'sub-title' => $subtitle,
                'description' => $videoFile->description,
                'time-to-die' => Carbon::parse($videoFile->show_end)->timestamp,
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
