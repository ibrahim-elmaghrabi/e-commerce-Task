<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
 

Route::post('register',[RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);
Route::get('stores', [StoreController::class, 'index']);

Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::post('stores', [StoreController::class, 'store']);
    Route::put('stores/{id}', [StoreController::class, 'update']);
    Route::delete('stores/{id}', [StoreController::class, 'destroy']);

});