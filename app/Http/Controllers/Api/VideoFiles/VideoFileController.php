<?php

namespace App\Http\Controllers\Api\VideoFiles;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\VideoFiles\VideoFileRequest;
use App\Repositories\VideoFiles\VideoFileRepository;
use App\Services\Kinopoisk\KinopoiskUnofficialService;
use Illuminate\Http\Request;

class VideoFileController extends BaseController
{
    protected function getRepositoryClass(): string
    {
        return VideoFileRepository::class;
    }

    public function getRequestClass(): string
    {
        return VideoFileRequest::class;
    }

    public function getMovieInfoFromKinopoisk(Request $request, KinopoiskUnofficialService $kinopoiskUnofficialService)
    {
        $this->validate($request, [
            'kinopoisk_url' => 'required|string|url',
        ]);

        return $this->success($kinopoiskUnofficialService->getMovieInfo($request->kinopoisk_url));
    }
}
