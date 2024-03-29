<?php

namespace Tests\Unit\Repository;

use App\Models\EPG\Epg;
use App\Models\Settings\EpgSetting;
use App\Repositories\EPG\EpgRepository;

class EpgRepositoryTest extends BaseRepository
{
    protected string $repositoryClass = EpgRepository::class;
    protected string $modelClass = Epg::class;

    protected function getFields(): array
    {
        return [
            'start' => '2023-12-19 11:20',
            'end' => '2023-12-20 14:10',
            'title' => 'titletitle',
            'sub_title' => 'sub_titlesub',
            'description' => 'descriptiondescription',
            'language' => 'langlang',
            'epg_setting_id' => EpgSetting::factory()->create()->id,
        ];
    }
}
