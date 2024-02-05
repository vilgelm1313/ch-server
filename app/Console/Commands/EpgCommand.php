<?php

namespace App\Console\Commands;

use App\Services\Epg\EpgService;
use Illuminate\Console\Command;

class EpgCommand extends Command
{
    protected $signature = 'epg:parse';

    public function handle(EpgService $epgService)
    {
        $epgService->run();
    }
}
