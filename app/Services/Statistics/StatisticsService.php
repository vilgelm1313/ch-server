<?php

namespace App\Services\Statistics;

use App\Models\Channels\Channel;
use App\Models\TvShow\TvShow;
use App\Models\VideoFiles\VideoFile;
use Illuminate\Support\Facades\DB;

class StatisticsService
{
    public function handle(array $data)
    {
        $name = $data['name'];
        $isVod = strpos($name, 'video/') !== false;
        $isSerial = strpos($name, '/season') !== false;
        $isNewSession = $data['request_type'] === 'new_session';
        if ($isVod) {
            $path = str_replace('video/', '', $name);
            $query = VideoFile::where('path', $path);
        } else if ($isSerial){
            $title = str_replace('video/', '', $name);
            $title = preg_replace('/\/.*/', '', $title);
            $query = TvShow::where('title', $title);
        } else {
            $query = Channel::where('flussonic', $name);
        }
        $params = ['last_viewed_at' => now()];
        if ($isNewSession) {
            $params['views'] = DB::raw('views + 1');
        } else {
            $params['watch_time'] = DB::raw('watch_time + 30');
        }
        $query->update($params);
    }
}
