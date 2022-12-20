<?php

use App\Http\Controllers\Command;
use App\Http\Controllers\ControllerClick;
use App\Http\Controllers\ControllerPartition;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

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

Route::get('/log', function () {

	Log::channel('elasticsearch')->error('Не удалось отправить уведомление', ['app', 'payment']);
});

Route::middleware(['web'])->group(function () {
	Route::resource('/book', SearchController::class);
});
//Route::get('/', [ControllerPartition::class, 'index']);
Route::get('/db', [ControllerClick::class, 'index']);

Route::get('/books/search', [SearchController::class, 'search']);

Route::get('/q', [Command::class, 'purchasePodcast']);
