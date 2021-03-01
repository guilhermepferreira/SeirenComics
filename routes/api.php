<?php

use App\Http\Controllers\Api\PaymentsController;
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

Route::prefix('payments')->middleware('apiJwt')->group(function () {
    Route::post('stripe', [PaymentsController::class, 'stripeCheckout']);
});

Route::middleware('apiJwt')->prefix('/user')->group(function (){
    Route::get('/',[UserController::class, 'getAll'])->middleware('adminMiddleware');
    Route::get('/profile',[UserController::class, 'show'])->name('get.profile');
    Route::post('/edit/{id}',[UserController::class, 'update'])->name('update.profile');
    Route::get('/deactivate/{id}',[UserController::class, 'destroy'])->name('deactivate.profile');
});

Route::get('home/',[ComicController::class, 'homePage'])->name('get.home');
Route::get('change/',[ComicController::class, 'moveImg'])->name('get.home');
Route::get('path/',[ComicController::class, 'changePath'])->name('get.home');

Route::middleware('apiJwt')->prefix('/comics')->group(function (){
    Route::get('/{id}',[ComicController::class, 'get'])->name('get.comic');
});
