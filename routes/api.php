<?php

use App\Http\Controllers\BooksController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'middleware' => 'cors'], function () {
    Route::resource('books', \App\Http\Controllers\BooksController::class);
    Route::resource('users', \App\Http\Controllers\UsersController::class);
    Route::post('register', '\App\Http\Controllers\AuthController@postRegister');
    Route::post('login', '\App\Http\Controllers\AuthController@authenticate');
});
