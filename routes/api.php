<?php

use App\Contracts\ApiRoutesEnum;
use App\Http\Controllers\UserController;
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

// open routes
Route::controller(UserController::class)->group(function () {
    Route::post(ApiRoutesEnum::LOGIN, 'login');
    Route::post(ApiRoutesEnum::USERS, 'create');
});

Route::middleware('auth:api')->group(function() {
    Route::controller(UserController::class)->group(function () {
        Route::get(ApiRoutesEnum::USERS, 'index');
        Route::get(ApiRoutesEnum::USERS_ID, 'show')->whereNumber('id');
        Route::put(ApiRoutesEnum::USERS_ID, 'update')->whereNumber('id');
        Route::delete(ApiRoutesEnum::USERS_ID, 'delete')->whereNumber('id');
    });
    
});