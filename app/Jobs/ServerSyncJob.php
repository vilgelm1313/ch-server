<?php

namespace App\Jobs;

use App\Models\Settings\Server;
use App\Services\Server\ServerSyncer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ServerSyncJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(protected Server $server, protected string $type)
    {
        $this->onQueue('worker');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        /**
         * @var ServerSyncer
         */
        $syncer = app()->make(ServerSyncer::class);
        $syncer->sync($this->server, $this->type);
    }
}
