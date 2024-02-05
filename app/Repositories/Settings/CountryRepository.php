<?php

namespace App\Repositories\Settings;

use App\Models\Settings\Country;
use App\Repositories\BaseRepository;

class CountryRepository extends BaseRepository
{
    protected function getClass(): string
    {
        return Country::class;
    }
}
