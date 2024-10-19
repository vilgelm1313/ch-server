<?php

use App\Http\Controllers\Api\Iptv\StatisticsController;
use Illuminate\Support\Facades\Route;

Route::get('statistics', [StatisticsController::class, 'index']);
