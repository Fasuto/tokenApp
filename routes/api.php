<?php

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

Route::prefix('v1')->group(function () {
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
    Route::group(['middleware' => ['verifyJwt']], function () {
        Route::get('/users', [\App\Http\Controllers\UserController::class, 'index']);
    });
    /*Route::post('/create-token', [\App\Http\Controllers\TokenController::class, 'create']);
    Route::post('/verify-token', [\App\Http\Controllers\TokenController::class, 'verify']);*/
});
