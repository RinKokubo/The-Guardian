<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConversationController;

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
Route::post('/defender-select-dialogue/{username}/{id}/send-message', [ConversationController::class, 'sendMessage']);
