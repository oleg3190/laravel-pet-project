<?php

use App\Http\Controllers\KafkaController;
use App\Http\Controllers\SearchApiController;
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

Route::resource('/book', SearchApiController::class);
Route::get('/books/search', [SearchApiController::class, 'search']);
//Route::get('/k', [KafkaController::class, 'get']);
