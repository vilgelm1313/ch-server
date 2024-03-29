<?php

namespace App\Console;

use App\Console\Commands\EpgCreateCommand;
use App\Console\Commands\EpgParseCommand;
use App\Console\Commands\RemoveOldEpgFilesCommand;
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
        $schedule->command(EpgParseCommand::class, ['--force'])
            ->dailyAt('03:00')
            ->withoutOverlapping()
            ->after(function() {
                $this->call(EpgCreateCommand::class);
            });
        
        $schedule->command(EpgParseCommand::class, ['--force'])
            ->dailyAt('19:00')
            ->withoutOverlapping()
            ->after(function() {
                $this->call(EpgCreateCommand::class);
            });

        $schedule->command(RemoveOldVideoFilesCommand::class)
            ->dailyAt('22:00')
            ->withoutOverlapping();

        $schedule->command(RemoveOldEpgFilesCommand::class)
            ->dailyAt('22:30')
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
