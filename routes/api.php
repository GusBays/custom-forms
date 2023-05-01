<?php

use App\Contracts\ApiRoutesEnum;
use App\Http\Controllers\FormController;
use App\Http\Controllers\FormUserController;
use App\Http\Controllers\OrganizationController;
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
Route::controller(OrganizationController::class)->group(function () {
    Route::post(ApiRoutesEnum::ORGANIZATIONS, 'store');
});

Route::controller(UserController::class)->group(function () {
    Route::post(ApiRoutesEnum::USERS_LOGIN, 'login');
});

Route::middleware('auth:api')->group(function() {
    Route::controller(UserController::class)->group(function () {
        Route::post(ApiRoutesEnum::USERS, 'store');
        Route::get(ApiRoutesEnum::USERS, 'index');
        Route::get(ApiRoutesEnum::USERS_ID, 'show')->whereNumber('id');
        Route::put(ApiRoutesEnum::USERS_ID, 'update')->whereNumber('id');
        Route::delete(ApiRoutesEnum::USERS_ID, 'destroy')->whereNumber('id');
    });
    
    Route::controller(FormController::class)->group(function () {
        Route::post(ApiRoutesEnum::FORMS, 'store');
        Route::get(ApiRoutesEnum::FORMS, 'index');
        Route::get(ApiRoutesEnum::FORMS_ID, 'show')->whereNumber('id');
        Route::put(ApiRoutesEnum::FORMS_ID, 'update')->whereNumber('id');
        Route::delete(ApiRoutesEnum::FORMS_ID, 'destroy')->whereNumber('id');
    });

    Route::controller(FormUserController::class)->group(function () {
        Route::post(ApiRoutesEnum::FORM_USERS, 'create');
        Route::get(ApiRoutesEnum::FORM_USERS, 'getByFormId')->whereNumber('id');
        Route::delete(ApiRoutesEnum::FORM_USERS_ID, 'delete')->where(['id', 'user_id']);
    });
});