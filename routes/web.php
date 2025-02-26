<?php

use App\Http\Controllers\user\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\OrderController;
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



Route::prefix('user/variations')->middleware(['auth', 'user'])->group(function () {
    Route::get('/products/{id}', [ProductController::class, 'show']);
    Route::post('/get-price', [ProductController::class, 'getPrice']);
});

Route::prefix('admin/orders')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/{id}', [OrderController::class, 'show'])->name('admin.orders.show');
    Route::post('/update-status/{id}', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    Route::delete('/{id}', [OrderController::class, 'destroy'])->name('admin.orders.destroy');
});





