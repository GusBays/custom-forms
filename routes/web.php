<?php

use App\Contracts\ActionEnum;
use App\Contracts\FillerActionEnum;
use App\Contracts\RedirectEnum;
use App\Contracts\UserActionEnum;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\FillerActionController;
use App\Http\Controllers\UserActionController;
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
    Route::get(ActionEnum::LOGOFF, 'logoff');
    Route::post(ActionEnum::CREATE_ORGANIZATION, 'createOrganization');
    Route::post(ActionEnum::RECOVER_PASSWORD, 'recoverPassword');
});

Route::middleware('auth:web')->group(function () {

    Route::controller(ViewsController::class)->group(function () {
        Route::get(RedirectEnum::ADMIN, 'admin');

        Route::get(RedirectEnum::FORMS, 'forms');

        Route::get(RedirectEnum::FILLERS, 'fillers');
        Route::get(RedirectEnum::FILLER_ID, 'filler')->whereNumber('id');
        Route::get(RedirectEnum::FILLER_NEW, 'newFiller');

        Route::get(RedirectEnum::USERS, 'users');
        Route::get(RedirectEnum::USER_ID, 'user')->whereNumber('id');
        Route::get(RedirectEnum::USER_NEW, 'newUser');
    });

    Route::controller(FillerActionController::class)->group(function () {
        Route::post(FillerActionEnum::NEW_FILLER, 'create');
    });

    Route::controller(UserActionController::class)->group(function () {
        Route::post(UserActionEnum::NEW_USER, 'create');
        Route::post(UserActionEnum::UPDATE_USER, 'update');
    });


});