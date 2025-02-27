<?php

use App\Http\Controllers\admin\AccountController;



use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\user\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/',  [UserController::class, 'index'])->name('home');

Route::get('/pageCategory',  [UserController::class, 'pageCategory'])->name('pageCategory');


Route::get('/login',  [UserController::class, 'login']);

Route::get('/cart',  [UserController::class, 'cart'])->name('cart');

Route::get( '/about',  [UserController::class, 'about'])->name('about');

Route::get( '/contact',  [UserController::class, 'contact'])->name('contact');

Route::get( '/myAccount',  [UserController::class, 'myAccount']);

Route::get( '/singleProduct',  [UserController::class, 'singleProduct']);



// Route::resource('/admin', AdminController::class);

Route::resource('/admin', AdminController::class);
Route::resource('/account',  AccountController::class);









// Route Đăng ký
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Route Đăng nhập
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Route Đăng xuất
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route yêu cầu đăng nhập mới truy cập được
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return 'Chào mừng bạn đến trang Dashboard!';
    })->name('dashboard');
});





use App\Http\Controllers\Admin\ProductController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', ProductController::class);
});
Route::delete('/admin/products/variant/{id}', [ProductController::class, 'destroyVariant'])->name('admin.products.variant.destroy');

