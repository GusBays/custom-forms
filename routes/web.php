<?php

use App\Contracts\ApiRoutesEnum;
use App\Contracts\RedirectEnum;
use App\Http\Controllers\ApiRequestsController;
use App\Http\Controllers\ViewsController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
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

// open routes
Route::controller(ViewsController::class)->group(function () {
    Route::get(RedirectEnum::HOME, 'home');
    Route::get(RedirectEnum::ENTRAR, 'entrar');
    Route::get(RedirectEnum::CADASTRO, 'cadastro');
});

Route::controller(ApiRequestsController::class)->group(function () {
    Route::post(RedirectEnum::LOGIN, 'login');
    Route::post(RedirectEnum::CREATE_ORGANIZATION, 'createOrganization');
});

Route::middleware('auth:web')->group(function () {

    Route::controller(ApiRequestsController::class)->group(function () {
        Route::get(RedirectEnum::ADMIN, 'admin');
        Route::get(RedirectEnum::FORMS, 'forms');
    });

});