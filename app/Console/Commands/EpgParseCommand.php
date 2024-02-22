<?php

namespace App\Console\Commands;

use App\Services\Epg\EpgService;
use Illuminate\Console\Command;

class EpgParseCommand extends Command
{
    protected $signature = 'epg:parse {--force}';

    public function handle(EpgService $epgService)
    {
        $force = $this->option('force');
        $epgService->run($force);
    }
}
