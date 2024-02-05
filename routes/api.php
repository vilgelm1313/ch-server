<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Channels\ChannelController;
use App\Http\Controllers\Api\Epg\EpgController;
use App\Http\Controllers\Api\File\FileController;
use App\Http\Controllers\Api\History\HistoryController;
use App\Http\Controllers\Api\Settings\CategoryController;
use App\Http\Controllers\Api\Settings\ConfigurationController;
use App\Http\Controllers\Api\Settings\CountryController;
use App\Http\Controllers\Api\Settings\EpgSettingController;
use App\Http\Controllers\Api\Settings\ServerController;
use App\Http\Controllers\Api\Settings\TariffController;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Api\VideoFiles\VideoFileController;
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
    Route::get('/history', [HistoryController::class, 'index']);
    Route::get('/epg', [EpgController::class, 'index']);
    Route::apiResource('category', CategoryController::class);
    Route::apiResource('configuration', ConfigurationController::class);
    //Route::apiResource('epg', EpgControlle::class);
    Route::apiResource('channel', ChannelController::class);
    Route::apiResource('video-file', VideoFileController::class);
    Route::post('file/upload', [FileController::class, 'upload']);
    Route::get('file/get', [FileController::class, 'getImage']);

    Route::post('epgsetting/{epg}/parse', [EpgSettingController::class, 'parse']);

    $activation = [
        'user' => UserController::class,
        'server' => ServerController::class,
        'epgsetting' => EpgSettingController::class,
        'tariff' => TariffController::class,
        'country' => CountryController::class,
        'videofile' => VideoFileController::class,
    ];

    Route::get('/videofile/kinopoisk/info', [VideoFileController::class, 'getMovieInfoFromKinopoisk']);
    foreach ($activation as $key => $value) {
        Route::apiResource($key, $value);
        Route::post("{$key}/{{$key}}/activate", [$value, 'activate']);
        Route::post("{$key}/{{$key}}/deactivate", [$value, 'deactivate']);
    }
});
