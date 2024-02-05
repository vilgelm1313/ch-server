<?php

namespace App\Repositories\Settings;

use App\Models\Settings\EpgSetting;
use App\Repositories\BaseRepository;

class EpgSettingRepository extends BaseRepository
{
    protected function getClass(): string
    {
        return EpgSetting::class;
    }
}
