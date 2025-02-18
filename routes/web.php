<?php

use App\Http\Controllers\user\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/',  [UserController::class, 'index']);

Route::get('/pageCategory',  [UserController::class, 'pageCategory']);


Route::get('/login',  [UserController::class, 'login']);

Route::get('/cart',  [UserController::class, 'cart']);

Route::get( '/about',  [UserController::class, 'about']);

Route::get( '/contact',  [UserController::class, 'contact']);

Route::get( '/myAccount',  [UserController::class, 'myAccount']);

Route::get( '/shopLeftSidebar',  [UserController::class, 'shopLeftSidebar']);

Route::get( '/singleProduct',  [UserController::class, 'singleProduct']);

Route::get('/products/{id}', [ProductController::class, 'show']);
Route::post('/get-price', [ProductController::class, 'getPrice']);







