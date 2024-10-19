<?php

namespace App\Http\Controllers\Api\Iptv;

use App\Http\Controllers\Api\ApiController;
use App\Services\Statistics\StatisticsService;
use Illuminate\Http\Request;

class StatisticsController extends ApiController
{
    public function index(Request $request, StatisticsService $statisticsService)
    {
        $request->validate([
            'name' => 'required|string',
            'request_type' => 'required|string',
        ]);

        $statisticsService->handle($request->all());

        return $this->success();
    }
}
