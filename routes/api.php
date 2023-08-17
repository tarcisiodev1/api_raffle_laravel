<?php

use App\Http\Controllers\Api\V1\ChurchController;
use App\Http\Controllers\Api\V1\DrawController;
use App\Http\Controllers\Api\V1\DrawGroupController;
use App\Http\Controllers\Api\V1\ParticipantController;
use App\Http\Controllers\Api\V1\PrizeController;
use App\Http\Controllers\Api\V1\WinnerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('v1')->group(function () {
    Route::apiResource('churches', ChurchController::class);
    Route::apiResource('draw-groups', DrawGroupController::class);
    Route::apiResource('draws', DrawController::class);
    Route::apiResource('prizes', PrizeController::class);
    Route::apiResource('participants', ParticipantController::class);
    Route::apiResource('winners', WinnerController::class);
});
