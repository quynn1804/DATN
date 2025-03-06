<?php

use App\Http\Controllers\user\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\user\CartController;
use App\Http\Controllers\PaymentController;
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


// Route::middleware('auth')->group(function () {
//     // Route::post('products/{id}/comments', [CommentController::class, 'store'])->name('comments.store');
//     Route::get('/cart', [CartController::class, 'index'])->name('cart');
//     Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
//     Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
// });
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
// thanh toan bang vnpayvnpay
Route::post('/vnpay_payment', [PaymentController::class, 'vnpay_payment']);

// thanh toan bang qr vnpayvnpay
// Route::get('/payment', function () {
//     return view('user.payment');
// })->name('payment');

// Route::post('/payment/create', [PaymentController::class, 'createPayment'])->name('payment.create');
// Route::get('/vnpay/callback', [PaymentController::class, 'paymentCallback'])->name('vnpay.callback');


