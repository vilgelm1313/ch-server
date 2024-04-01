<?php

namespace App\Services\Server\Syncers;

use App\Models\Settings\Server;
use App\Models\VideoFiles\VideoFile;
use Carbon\Carbon;
use Illuminate\Support\Str;

class TvshowSyncer implements ServerSyncerContract
{
    public function getData(Server $server): array
    {
        $shows = $server->tvShows()->where('is_active', true)
            ->with('seasons')
            ->where('show_end', '>=', Carbon::now()->format('Y-m-d'))
            ->where('show_start', '<=', Carbon::now()->format('Y-m-d'))
            ->orderBy('show_end', 'desc')
            ->get();

        $data = [];
        /**
         * @var TvShow $show
         */
        foreach ($shows as $show) {
            $title = [];
            $$filename = $show->title;
            $title[] = $show->title;
            if ($show->original_title) {
                $title[] = $show->original_title;
            }
            $episodes = [];

            foreach ($show->seasons as $season) {
                if ($season->episodes) {
                    array_merge($episodes, $season->episodes);
                }
            }
            $data[$filename] = [
                'filename' => $filename,
                'title' => implode(' | ', $title),
                'path' => 'path',
                'poster' => 'plati.one/logo/' . $show->sync_logo,
                'episodes' => $episodes,
                'description' => '',
            ];
        }

        return $data;
    }

    public function getType(): string
    {
        return 'serials';
    }

    public function getName(): string
    {
        return '';
    }
}
