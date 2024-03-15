<?php

namespace App\Console\Commands;

use App\Models\VideoFiles\VideoFile;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class EpgParseCommand extends Command
{
    protected $signature = 'video-file:remove-old';

    public function handle()
    {
        $videoFile = VideoFile::where('show_end', '<', Carbon::now()->subDays(10)->format('Y-m-d'))
            ->get();

        foreach ($videoFile as $file) {
            $file->delete();

            Storage::disk('ftp')->delete($file->path);
        }
    }
}
