<?php

use App\Contracts\RedirectEnum;
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
    Route::get(RedirectEnum::RESPONDER, 'responder');
});

Route::middleware('auth:web')->group(function () {

    Route::controller(ViewsController::class)->group(function () {
        Route::get(RedirectEnum::ADMIN, 'admin');

        Route::get(RedirectEnum::FORMS, 'forms');
        Route::get(RedirectEnum::FORM_ID, 'form')->whereNumber('id');
        Route::get(RedirectEnum::FORM_NEW, 'newForm');

        Route::get(RedirectEnum::FILLERS, 'fillers');
        Route::get(RedirectEnum::FILLER_ID, 'filler')->whereNumber('id');
        Route::get(RedirectEnum::FILLER_NEW, 'newFiller');

        Route::get(RedirectEnum::USERS, 'users');
        Route::get(RedirectEnum::USER_ID, 'user')->whereNumber('id');
        Route::get(RedirectEnum::USER_NEW, 'newUser');
    });
});