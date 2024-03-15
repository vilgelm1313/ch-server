<?php

namespace App\Console;

use App\Console\Commands\EpgCreateCommand;
use App\Console\Commands\EpgParseCommand;
use App\Console\Commands\RemoveOldVideoFilesCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @codeCoverageIgnore
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command(EpgParseCommand::class, ['--force'])
            ->dailyAt('23:00')
            ->withoutOverlapping()
            ->after(function() {
                $this->call(EpgCreateCommand::class);
            });

        $schedule->command(RemoveOldVideoFilesCommand::class)
            ->dailyAt('22:00')
            ->withoutOverlapping();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
