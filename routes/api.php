<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GameInformationController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\UserScoreController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\MatchInfoController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', [UserController::class, 'index']);
Route::get('/game/{id}', [GameInformationController::class, 'show']);
Route::get('/getGame/{id}',  [GameInformationController::class, 'attackerShow']);
Route::get('/score/{gameId}', [ScoreController::class, 'calculate']);
Route::post('/game-result', [ScoreController::class, 'store']);
Route::get('getScore/{gameId}', [ScoreController::class, 'getScore']);

Route::post('user_scores', [UserScoreController::class, 'store']);

Route::get('/notice/{id}', [NoticeController::class, 'show']);

Route::get('/match-info', [MatchInfoController::class, 'getMatchInfo']);


// Route::get('/conversation/start', 'App\Http\Controllers\ConversationController@start');
// Route::post('/conversation/message', 'App\Http\Controllers\ConversationController@sendMessage');
