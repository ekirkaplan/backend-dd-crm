<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
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

Route::prefix('auth')->group(function () {
    Route::controller(LoginController::class)->group(function () {
        Route::post('refresh', 'refresh');
        Route::post('logout', 'logout');
        Route::post('login', 'login');
    });
});

Route::middleware(['jwt.verify'])->group(function () {
    Route::post('logout', [LoginController::class, 'logout']);
    Route::get('/auth/me', [LoginController::class, 'me']);
    Route::get('medias/get-media-by-id/{id}', [MediaController::class, 'getMediaById']);

    Route::controller(UserController::class)->prefix('users')->group(function () {
        Route::get('get-all', 'getAll');
        Route::get('get-filtered', 'getFiltered');
    });
    Route::apiResource('users', UserController::class);



    Route::controller(RoleController::class)->prefix('roles')->group(function () {
        Route::get('get-all', 'getAll');
        Route::get('get-filtered', 'getFiltered');
    });
    Route::apiResource('roles', RoleController::class);

});
