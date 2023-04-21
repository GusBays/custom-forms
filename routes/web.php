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
});

Route::middleware('auth:web')->group(function () {

    Route::controller(ViewsController::class)->group(function () {
        Route::get(RedirectEnum::ADMIN, 'admin');
    });

});