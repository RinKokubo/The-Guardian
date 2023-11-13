<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GameInformationController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\UserScoreController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\MatchInfoController;
use App\Http\Controllers\CardSelectController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AttackerCardInfoController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Broadcast;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//);
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Broadcast::routes(['middleware' => ['auth:api']]);

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'showUserName']);
Route::post('/login-without-password', [AuthController::class, 'loginWithoutPassword']);
Route::get('/game/{id}', [GameInformationController::class, 'show']);
Route::get('/attacker-card-info/{card}', [AttackerCardInfoController::class, 'show']);
Route::get('/attacker-card-info/{gameId}/{card}', [AttackerCardInfoController::class, 'showGame']);
Route::get('/getGame/{id}',  [GameInformationController::class, 'attackerShow']);
Route::get('/score/{gameId}', [ScoreController::class, 'calculate']);
Route::post('/game-result', [ScoreController::class, 'store']);
Route::get('getScore/{gameId}', [ScoreController::class, 'getScore']);

Route::post('/messages', [MessageController::class, 'store']);

Route::post('user_scores', [UserScoreController::class, 'store']);

Route::get('/notice/{id}', [NoticeController::class, 'show']);

Route::get('/match-info', [MatchInfoController::class, 'getMatchInfo']);
Route::post('/attacker-select-card', [CardSelectController::class, 'attackerSelectCard']);
Route::post('/defender-select-card', [CardSelectController::class, 'defenderSelectCard']);
Route::post('/defender-transit', [CardSelectController::class, 'defenderTransit']);
Route::post('/users/{userId}/update-waiting-status', [UserController::class, 'updateWaitingStatus']);
Route::get('/users/{userId}/waiting-status', [UserController::class, 'getWaitingStatus']);


// Route::get('/conversation/start', 'App\Http\Controllers\ConversationController@start');
// Route::post('/conversation/message', 'App\Http\Controllers\ConversationController@sendMessage');
