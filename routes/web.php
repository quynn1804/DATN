<?php
// use App\Http\Controllers\CommentController;
use App\Http\Controllers\admin\AccountController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\user\CartController;
use Illuminate\Support\Facades\Route;

// Trang chủ
Route::get('/', [UserController::class, 'index'])->name('home');

// Các trang tĩnh
Route::get('/pageCategory', [UserController::class, 'pageCategory'])->name('pageCategory');
// Route::get('/cart', [UserController::class, 'cart'])->name('cart');
Route::get('/about', [UserController::class, 'about'])->name('about');
Route::get('/contact', [UserController::class, 'contact'])->name('contact');
Route::get('/myAccount', [UserController::class, 'myAccount']);
Route::get('/product/{id}', [UserController::class, 'singleProduct'])->name('singleProduct');

// search sp
Route::get('/search', [UserController::class, 'search'])->name('search');

// Xác thực người dùng
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('products/{id}/comments', [CommentController::class, 'store'])->middleware('auth')->name('comments.store');

// Dashboard (yêu cầu đăng nhập)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return 'Chào mừng bạn đến trang Dashboard!';
    })->name('dashboard');

    // Admin routes (yêu cầu đăng nhập)
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('dashboard');
        Route::resource('account', AccountController::class);
        Route::resource('comments', CommentController::class)->only(['index', 'destroy']);

        Route::resource('products', ProductController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('orders', OrderController::class);
        Route::delete('/products/variant/{id}', [ProductController::class, 'destroyVariant'])->name('products.variant.destroy');
    });
});




// Giỏ hàng (yêu cầu đăng nhập)
Route::middleware('auth')->group(function () {
    Route::post('products/{id}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
});

