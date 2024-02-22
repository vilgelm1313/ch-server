<?php

namespace App\Console\Commands;

use App\Services\Epg\EpgCreateService;
use Illuminate\Console\Command;

class EpgCreateCommand extends Command
{
    protected $signature = 'epg:create';

    public function handle(EpgCreateService $epgService)
    {
        $epgService->run();
    }
}
