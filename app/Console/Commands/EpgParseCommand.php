<?php

namespace App\Console\Commands;

use App\Services\Epg\EpgService;
use Illuminate\Console\Command;

class EpgParseCommand extends Command
{
    protected $signature = 'epg:parse';

    public function handle(EpgService $epgService)
    {
        $epgService->run();
    }
}
