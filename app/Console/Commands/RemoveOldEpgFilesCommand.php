<?php

namespace App\Console\Commands;

use App\Models\VideoFiles\VideoFile;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class RemoveOldEpgFilesCommand extends Command
{
    protected $signature = 'epg:remove-old';

    public function handle()
    {
        $files = collect(Storage::allFiles('app/epg'));
        $old = Carbon::now()->subDays(10);
        foreach ($files as $file) {
            $lastModified =  Storage::lastModified($file);
            $lastModified = Carbon::parse($lastModified);
            if ($lastModified->lt($old)) {
                Storage::delete($file);
            }
        }
    }
}
