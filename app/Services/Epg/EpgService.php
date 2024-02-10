<?php

namespace App\Services\Epg;

use App\Models\Settings\EpgSetting;
use App\Services\Log\LoggerService;
use Illuminate\Database\Eloquent\Collection;

class EpgService
{
    protected LoggerService $logger;

    public function __construct()
    {
        $this->logger = app()->make(LoggerService::class);
    }

    public function run(): void
    {
        $epgSettings = $this->getEpgSettingsToRun();

        foreach ($epgSettings as $epgSetting) {
            $this->parseEpg($epgSetting);
        }
    }

    public function parseEpg(EpgSetting $epgSetting): EpgSetting
    {
        try {
            $epgSetting->processing = true;
            $epgSetting->save();
            $this->log('start', $epgSetting);

            $parser = new EpgParserService($epgSetting);
            $parser->parse();
            $epgSetting->has_error = false;
            $epgSetting->error = null;
            $this->log('finish', $epgSetting);

        } catch (\Exception $e) {
            $this->log('error', $epgSetting, $e->getMessage());
            $epgSetting->has_error = true;
            $epgSetting->error = $e->getMessage();
        } finally {
            $epgSetting->processing = false;
            $epgSetting->save();
        }

        return $epgSetting;
    }

    protected function getEpgSettingsToRun(): Collection
    {
        return EpgSetting::where('processing', false)
            ->where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('last_run')
                    ->orWhereRaw('TIMESTAMPDIFF(MINUTE, last_run, NOW()) > refresh_period');
            })
            ->get();
    }

    protected function log(string $action, EpgSetting $epgSetting, string $extra = ''): void
    {
        $this->logger->database([
            'type' => 'epg',
            'action' => $action,
            'value' => $epgSetting->name . ($extra ? ' ' . $extra : ''),
        ]);
    }
}
