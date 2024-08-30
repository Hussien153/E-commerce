<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);    
});

//Brands CRUD
Route::group(['prefix' => 'brand', 'namespace' => 'Brands'], function () {

    Route::get('/index', [BrandsController::class, 'index']);
    Route::get('/show/{id}', [BrandsController::class ,'show']);
    Route::post('/store', [BrandsController::class , 'store']);
    Route::put('/update_brand/{id}', [BrandsController::class ,'update_brand']);
    Route::delete('/delete_brand{id}', [BrandsController::class , 'delete_brand']);
});

// Category CRUD
Route::group(['prefix' => 'category', 'namespace' => 'Categories'], function () {

    Route::get('/index', [CategoriesController::class, 'index']);
    Route::get('/show/{id}', [CategoriesController::class,'show']);
    Route::post('/store', [CategoriesController::class, 'store']);
    Route::put('/update_category{id}', [CategoriesController::class,'update_category']);
    Route::delete('/delete_category{id}', [CategoriesController::class, 'delete_category']);
});

Route::group(['prefix' => 'Location', 'namespace' => 'locations'], function () {
    Route::post('/store', [LocationController::class, 'store']);
    Route::put('/update/{id}', [LocationController::class, 'update']);
    Route::delete('/destroy/{id}', [LocationController::class, 'destory']);
});

Route::group(['prefix' => 'Product', 'namespace' => 'products'], function () {
    Route::get('/index', [ProductController::class, 'index']);
    Route::get('/show/{id}', [ProductController::class, 'show']);
    Route::post('/store', [ProductController::class, 'store']);
    Route::put('/update/{id}', [ProductController::class, 'update']);
    Route::delete('/destroy/{id}', [ProductController::class, 'destory']);
});

Route::group(['prefix' => 'Order', 'namespace' => 'orders'], function () {
    Route::get('/index', [OrderController::class, 'index']);
    Route::get('/show/{id}', [OrderController::class, 'show']);
    Route::post('/store', [OrderController::class, 'store']);
    Route::get('/get_order_items/{id}', [OrderController::class, 'get_order_items']);
    Route::get('/get_user_order/{id}', [OrderController::class, 'get_user_order']);
    Route::get('/change_order_status/{id}', [OrderController::class, 'change_order_status']);
});
