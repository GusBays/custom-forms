<?php

use App\Contracts\ActionEnum;
use App\Contracts\RedirectEnum;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\ViewsController;
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
    Route::get(RedirectEnum::RECUPERAR, 'recuperar');
});

Route::controller(ActionController::class)->group(function () {
    Route::post(ActionEnum::LOGIN, 'login');
    Route::post(ActionEnum::CREATE_ORGANIZATION, 'createOrganization');
    Route::post(ActionEnum::RECOVER_PASSWORD, 'recoverPassword');
});

Route::middleware('auth:web')->group(function () {

    Route::controller(ViewsController::class)->group(function () {
        Route::get(RedirectEnum::ADMIN, 'admin');
        Route::get(RedirectEnum::FORMS, 'forms');
    });

});