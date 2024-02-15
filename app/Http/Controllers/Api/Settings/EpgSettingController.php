<?php

namespace App\Http\Controllers\Api\Settings;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Settings\EpgSettingRequest;
use App\Jobs\EpgParseJob;
use App\Models\Settings\EpgSetting;
use App\Repositories\Settings\EpgSettingRepository;

class EpgSettingController extends BaseController
{
    public function parse(EpgSetting $epg)
    {
        $epg->processing = true;
        $epg->save();

        EpgParseJob::dispatch($epg);

        return $this->success();
    }

    protected function getRepositoryClass(): string
    {
        return EpgSettingRepository::class;
    }

    public function getRequestClass(): string
    {
        return EpgSettingRequest::class;
    }
}
