<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\AuthController;
use \App\Http\Controllers\Api\UserController;
use \App\Http\Controllers\Api\ComicController;
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

Route::post('/login', [AuthController::class,'login']);
Route::post('/register', [UserController::class,'store']);

Route::middleware('apiJwt')->prefix('/user')->group(function (){
    Route::get('/profile',[UserController::class, 'show'])->name('get.profile');
    Route::post('/edit/{id}',[UserController::class, 'update'])->name('update.profile');
    Route::get('/deactivate/{id}',[UserController::class, 'destroy'])->name('deactivate.profile');
});

Route::middleware('apiJwt')->prefix('/comics')->group(function (){
    Route::get('/',[ComicController::class, 'homePage'])->name('get.home');
//    Route::post('/edit/{id}',[UserController::class, 'update'])->name('update.profile');
//    Route::get('/deactivate/{id}',[UserController::class, 'destroy'])->name('deactivate.profile');
});
