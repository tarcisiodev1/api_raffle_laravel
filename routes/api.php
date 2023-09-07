<?php

use App\Http\Controllers\Api\V1\ChurchController;
use App\Http\Controllers\Api\V1\DrawController;
use App\Http\Controllers\Api\V1\DrawExecutionController;
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
    Route::prefix('draws/{draw}')->group(function () {
        Route::apiResource('participants', ParticipantController::class)->except(['create', 'edit']);
        Route::apiResource('winners', WinnerController::class);
        Route::apiResource('prizes', PrizeController::class);
    });
    Route::post('participants/{participantId}/buy-tickets', [ParticipantController::class, 'buyTickets']);
    Route::post('draws/{draw}/execute', [DrawExecutionController::class, 'index']);
});
