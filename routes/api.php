<?php

use App\Http\Controllers\Api\PaymentsController;
use App\Http\Controllers\Api\PlansController;
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
Route::post('/loginGoogle', [AuthController::class,'loginGoogle']);
Route::post('/register', [UserController::class,'store']);
Route::get('addSerie',[ComicController::class, 'addSerie']);
Route::get('/addComentarios',[ComicController::class, 'comentarios']);

Route::prefix('payments')->middleware('apiJwt')->group(function () {
    Route::post('stripe', [PaymentsController::class, 'stripeCheckout']);
});

Route::get('plans', [PlansController::class, 'index'])->middleware('apiJwt');
Route::post('plans/update', [PlansController::class, 'updatePlan'])->middleware('apiJwt','adminMiddleware')->name('admin.update.plan');

Route::middleware('apiJwt')->prefix('/user')->group(function (){
    Route::get('/',[UserController::class, 'getAll'])->middleware('adminMiddleware');
    Route::get('/profile',[UserController::class, 'show'])->name('get.profile');
    Route::post('/edit/{id}',[UserController::class, 'update'])->name('update.profile');
    Route::get('/deactivate/{id}',[UserController::class, 'destroy'])->name('deactivate.profile');
});

Route::get('home/',[ComicController::class, 'homePage'])->name('get.home');


Route::middleware('apiJwt')->prefix('/comics')->group(function (){
    Route::get('/types',[ComicController::class, 'getTypes'])->middleware('adminMiddleware')->name('types.comic');
    Route::get('/calendario',[ComicController::class, 'calendar'])->name('get.comic.calendar');
    Route::Post('/create',[ComicController::class, 'createComic'])->middleware('adminMiddleware')->name('create.comic');
    Route::get('/{id}',[ComicController::class, 'get'])->name('get.comic');
    Route::get('/',[ComicController::class, 'getAll'])->name('get.comic.all');
    Route::prefix('/traductions')->group(function (){
        Route::post('/create',[ComicController::class,'createTraduction'])->middleware('adminMiddleware')->name('create.comic.traduction');
        Route::post('/update',[ComicController::class,'updateTraduction'])->middleware('adminMiddleware')->name('update.comic.traduction');
    });
});

