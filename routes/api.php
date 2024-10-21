<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Channels\ChannelController;
use App\Http\Controllers\Api\Epg\EpgController;
use App\Http\Controllers\Api\File\FileController;
use App\Http\Controllers\Api\History\HistoryController;
use App\Http\Controllers\Api\Iptv\BanDomainController;
use App\Http\Controllers\Api\Iptv\BanIpController;
use App\Http\Controllers\Api\Iptv\DealerController;
use App\Http\Controllers\Api\Iptv\NewsController;
use App\Http\Controllers\Api\Iptv\StatisticsController;
use App\Http\Controllers\Api\Iptv\StreamServerController;
use App\Http\Controllers\Api\Iptv\TariffController;
use App\Http\Controllers\Api\Iptv\VideoServerController;
use App\Http\Controllers\Api\Settings\CategoryController;
use App\Http\Controllers\Api\Settings\ConfigurationController;
use App\Http\Controllers\Api\Settings\CountryController;
use App\Http\Controllers\Api\Settings\EpgSettingController;
use App\Http\Controllers\Api\Settings\ServerController;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Api\TvShow\TvShowController;
use App\Http\Controllers\Api\TvShow\TvShowSeasonController;
use App\Http\Controllers\Api\VideoFiles\VideoFileController;
use App\Models\Iptv\VideoServer;
use App\Models\TvShow\TvShowSeason;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('auth/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::get('/history', [HistoryController::class, 'index'])->middleware('can:admin');
    Route::get('/epg', [EpgController::class, 'index'])->middleware('can:admin');
    Route::apiResource('configuration', ConfigurationController::class)->middleware('can:admin');
    Route::post('file/upload', [FileController::class, 'upload']);
    Route::get('file/get', [FileController::class, 'getImage']);
    Route::post('epgsetting/{epg}/parse', [EpgSettingController::class, 'parse'])->middleware('can:admin');

    $activation = [
        'user' => [
            'controller' => UserController::class,
            'ability' => 'admin'
        ],
        'epgsetting' => [
            'controller' => EpgSettingController::class,
            'ability' => 'admin'
        ],
        'server' => [
            'controller' => ServerController::class,
            'ability' => ''
        ],
        'country' => [
            'controller' => CountryController::class,
            'ability' => ''
        ],
        'videofile' => [
            'controller' => VideoFileController::class,
            'ability' => ''
        ],
        'channel' => [
            'controller' => ChannelController::class,
            'ability' => ''
        ],
        'category' => [
            'controller' => CategoryController::class,
            'ability' => ''
        ],
        'tvshow' => [
            'controller' => TvShowController::class,
            'ability' => ''
        ],
        'season' => [
            'controller' => TvShowSeasonController::class,
            'ability' => ''
        ],
        'news' => [
            'controller' => NewsController::class,
            'ability' => 'admin'
        ],
        'banip' => [
            'controller' => BanIpController::class,
            'ability' => 'admin'
        ],
        'bandomain' => [
            'controller' => BanDomainController::class,
            'ability' => 'admin'
        ],
        'tariff' => [
            'controller' => TariffController::class,
            'ability' => 'admin'
        ],
        'videoserver' => [
            'controller' => VideoServerController::class,
            'ability' => 'admin'
        ],
        'streamserver' => [
            'controller' => StreamServerController::class,
            'ability' => 'admin'
        ],
        'dealer' => [
            'controller' => DealerController::class,
            'ability' => 'admin'
        ],
    ];

    Route::get('/videofile/kinopoisk/info', [VideoFileController::class, 'getMovieInfoFromKinopoisk']);
    foreach ($activation as $key => $value) {
        Route::get("{$key}/all", [$value['controller'], 'all']);
        Route::apiResource($key, $value['controller'])->middleware('can:'. $value['ability']);
        Route::post("{$key}/{{$key}}/activate", [$value['controller'], 'activate'])->middleware('can:'. $value['ability']);
        Route::post("{$key}/{{$key}}/deactivate", [$value['controller'], 'deactivate'])->middleware('can:'. $value['ability']);
    }

    Route::post('/server/sync/all', [ServerController::class, 'syncAll']);
    Route::post('/server/{server}/relation', [ServerController::class, 'addRelations']);
    Route::post('/server/{server}/sync', [ServerController::class, 'sync']);

    Route::post('/category/{category}/channels', [CategoryController::class, 'setChannelsPositions']);
    Route::get('/channel/{channel}/epg', [EpgController::class, 'channelEpg']);

    Route::get('/tvshow/{show}/season', [TvShowSeasonController::class, 'view']);
    Route::post('/tvshow/{show}/season', [TvShowSeasonController::class, 'addSeason']);

    Route::post('/channel/statistics/clear', [StatisticsController::class, 'clearChannelsStatistics']);

    Route::post('/dealer/{dealer}/amount', [DealerController::class, 'addAmount']);
    Route::get('/dealer/{dealer}/invoice', [DealerController::class, 'invoices']);
});
