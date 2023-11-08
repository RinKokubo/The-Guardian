<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\UserScoreController;
use App\Http\Controllers\GameInformationController;
use App\Http\Controllers\NoticeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', function () {
    return view('hello');
});

Route::get('/select-account', function () {
    return view('selectAccount');
});
Route::post('/defender-select-dialogue/{username}/{id}/start', [ConversationController::class, 'start']);
//Route::post('/defender-select-dialogue/{username}/{id}/send-message', [ConversationController::class, 'sendMessage']);
Route::post('/defender-select-dialogue/send-message', [ConversationController::class, 'sendMessage']);

Route::get('messages/export/', [ConversationController::class, 'export']);
Route::get('game_results/export/', [ScoreController::class, 'export']);
Route::get('user_scores/export/', [UserScoreController::class, 'export']);
Route::get('game_info/export/', [GameInformationController::class, 'export']);
Route::get('card_info/export/', [NoticeController::class, 'export']);
