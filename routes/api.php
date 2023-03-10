<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/* use App\Http\Controllers\Api\{
    OrderController,
    StoreController,
    ProductController,
}; */
use App\Http\Controllers\Api\{
    Auth\LoginController,
    Auth\RegisterController,
    Auth\LogoutController,
    OrderController,
    StoreController,
    ProductController,
};

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
Route::get('stores/{id}', [StoreController::class, 'show']);

Route::get('products', [ProductController::class, 'index']);
Route::get('stores/{storeId}/products', [ProductController::class, 'productsByStore']);
Route::get('products/{id}', [ProductController::class, 'show']);

Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::post('stores', [StoreController::class, 'store']);
    Route::put('stores/{id}', [StoreController::class, 'update']);
    Route::delete('stores/{id}', [StoreController::class, 'destroy']);

    Route::post('products', [ProductController::class, 'store']);
    Route::put('products/{id}', [ProductController::class, 'update']);
    Route::delete('products/{id}', [ProductController::class, 'destroy']);

    Route::get('orders', [OrderController::class, 'index']);
    Route::get('orders/{id}', [OrderController::class, 'show']);
    Route::post('orders', [OrderController::class, 'store']);
    Route::post('logout', [LogoutController::class, 'logout']);
});