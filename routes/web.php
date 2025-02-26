<?php

use App\Http\Controllers\admin\AccountController;



use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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



// Route::resource('/admin', AdminController::class);
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


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('', [AdminController::class, 'index']);
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
});
Route::delete('/admin/products/variant/{id}', [ProductController::class, 'destroyVariant'])->name('admin.products.variant.destroy');
