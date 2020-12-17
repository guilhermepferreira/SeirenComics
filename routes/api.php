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

Route::get('/att',[\App\Http\Controllers\Api\UserController::class, 'alterDates']);
Route::post('/login', [\App\Http\Controllers\Api\AuthController::class,'login']);

Route::middleware('apiJwt')->prefix('/user/profile')->group(function (){
    Route::get('/',[\App\Http\Controllers\Api\UserController::class, 'index'])->name('get.profile');
});
