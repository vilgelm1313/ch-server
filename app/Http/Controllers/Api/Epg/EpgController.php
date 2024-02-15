<?php

namespace App\Http\Controllers\Api\Epg;

use App\Http\Controllers\Api\BaseController;
use App\Models\Channels\Channel;
use App\Repositories\EPG\EpgRepository;
use Illuminate\Http\Request;

class EpgController extends BaseController
{
    protected function getRepositoryClass(): string
    {
        return EpgRepository::class;
    }

    public function getRequestClass(): string
    {
        return '';
    }

    public function channelEpg(Request $request, Channel $channel)
    {
        $this->validate($request, [
            'per_page' => 'nullable|in:10,25,50,100',
        ]);

        $models = $this->getRepository()->channelEpg($channel, $request->per_page, $request->all());

        return $this->success($models);
    }
}
