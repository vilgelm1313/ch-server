<?php

namespace Database\Seeders;

use App\Models\VideoFiles\VideoFile;
use Carbon\Carbon;

class VideoFilesSeeder extends InitialDataSeeder
{
    public function processItem(array $item): void
    {
        $title = explode('|', $item['title']);
        $ruTitle = trim($title[0]);
        $enTitle = trim($title[1]);
        $v = VideoFile::where('title', $ruTitle)->first();
        if (!$v) {
            $v = new VideoFile();
        }
        $v->title = $ruTitle;
        $v->original_title = $enTitle;
        $v->poster = 'https://' . $item['poster'];
        $v->description = $item['description'];
        $v->is_active = (int) $item['active'];
        $v->show_start = now();
        $v->show_end = Carbon::createFromTimestamp($item['time-to-die']);
        $v->path = $item['path'] . '/' . $item['filename'];

        $info = explode('|', $item['sub-title']);
        $v->imbd = trim(str_replace('IMDb: ', '', $info[0]));
        $key = 1;
        if (isset($info[1])) {
            $info[1] = trim($info[1]);
        }
        if (strpos($info[1], 'Kinopoisk:') !== false) {
            $v->imbd = trim(str_replace('Kinopoisk: ', '', $info[1]));
            $key = 2;
        }

        $info = explode('.', $info[$key]);
        $v->year = trim($info[0]);
        $v->country = trim($info[1]);
        if (empty($info[2])) {
            dd($ruTitle);
        }
        $v->genres = trim($info[2]);

        $v->director = str_replace('Режиссер: ', '', trim($info[3]));
        $v->actors = str_replace('В ролях: ', '', trim($info[4]));

        $v->save();
    }

    public function getFileName(): string
    {
        return 'files';
    }
}
