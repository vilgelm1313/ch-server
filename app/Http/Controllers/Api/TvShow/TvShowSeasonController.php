<?php

namespace App\Http\Controllers\Api\TvShow;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\TvShow\TvShowSeasonRequest;
use App\Repositories\TvShow\TvShowSeasonRepository;

class TvShowSeasonController extends BaseController
{
    protected function getRepositoryClass(): string
    {
        return TvShowSeasonRepository::class;
    }

    public function getRequestClass(): string
    {
        return TvShowSeasonRequest::class;
    }

    public function view(int $showId)
    {
        $response = $this->getRepository()->view($showId);

        return $this->success($response);
    }

    public function addSeason(int $showId, TvShowSeasonRequest $request)
    {
        $response = $this->getRepository()->addSeason($showId, $request->title);

        return $this->success($response);
    }
}
