<?php

namespace App\Jobs;

use App\Models\Settings\EpgSetting;
use App\Services\Epg\EpgService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class EpgParseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(protected EpgSetting $epgSetting)
    {
        //$this->onQueue('')
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        /**
         * @var EpgService $epgService
         */
        $epgService = app()->make(EpgService::class);
        $epgService->parseEpg($this->epgSetting);
    }
}
