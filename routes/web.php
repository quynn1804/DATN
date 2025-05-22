<?php
// use App\Http\Controllers\CommentController;
use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\Admin\StatisticController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\VoucherController;
use App\Http\Controllers\User\ForgotPasswordController;
use App\Http\Controllers\user\ResetPasswordController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserOrderController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\StockImportController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmationMail;
use App\Models\Order;

use App\Http\Controllers\Admin\ApplyVoucherController;
use App\Http\Controllers\User\PaymentController;
use App\Models\Cart;
use Illuminate\Support\Facades\Route;
// Trang chủ
Route::get('/', [UserController::class, 'index'])->name('home');

// Các trang tĩnh
Route::get('/pageCategory', [UserController::class, 'pageCategory'])->name('pageCategory');
// Route::get('/cart', [UserController::class, 'cart'])->name('cart');
Route::get('/about', [UserController::class, 'about'])->name('about');
Route::get('/contact', [UserController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/myAccount', [UserController::class, 'myAccount'])->name('myAccount')->middleware('auth');
Route::post('/myAccount/update', [UserController::class, 'updateAccount'])->name('user.account.update');
Route::get('/product/{id}', [UserController::class, 'singleProduct'])->name('singleProduct');
//sản phẩm theo danh mục
Route::get('/products/filter', [UserController::class, 'pageCategory'])->name('products.filter');
//top 10 sp
Route::get('/top-favorite-products', [ProductController::class, 'topFavorites'])->name('products.topFavorites');

// search sp
Route::get('/search', [UserController::class, 'search'])->name('search');

// Xác thực người dùng
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Route::post('products/{id}/comments', [CommentController::class, 'store'])->middleware('auth')->name('comments.store');

// Dashboard (yêu cầu đăng nhập)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return 'Chào mừng bạn đến trang Dashboard!';
    })->name('dashboard');

    Route::prefix('admin')->middleware(['isAdmin'])->name('admin.')->group(function () {
        // Route::get('/', function () {
        //     return redirect()->route('admin.statistic.index');
        // })->name('dashboard');



        Route::get('/', [AdminController::class, 'index'])->name('dashboard');

        Route::resource('statistic', StatisticController::class);
        Route::resource('contacts', ContactController::class)->except(['create', 'store']);
        Route::resource('account', AccountController::class);
        Route::resource('comments', CommentController::class)->only(['index', 'destroy', 'show']);
        Route::resource('vouchers', VoucherController::class);
        Route::resource('products', ProductController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('orders', OrderController::class);
        Route::resource('stock-imports', StockImportController::class);
        Route::delete('/products/variant/{id}', [ProductController::class, 'destroyVariant'])->name('products.variant.destroy');

        Route::get('/chats', [MessageController::class, 'index'])->name('chats.index');
        Route::post('/chats/{userId}/write', [MessageController::class, 'store'])->name('chats.write');
        Route::get('/chats/{userId}/show', [MessageController::class, 'show'])->name('chats.detail');


        Route::get('/statistical/products', [ProductController::class, 'statisticalProduct'])->name('statistical.products');
        Route::get('/statistical/users', [AccountController::class, 'statisticalAccount'])->name('statistical.users');
    });




    // Giỏ hàng (yêu cầu đăng nhập)
    // Route::middleware('auth')->group(function () {
    //     Route::post('/account/update', [UserController::class, 'updateAccount'])->name('updateAccount');
    //     Route::post('/orders/{order}/comment', [CommentController::class, 'store'])
    //         ->name('comments.store');
    //     Route::post('products/{id}/cart', [CartController::class, 'store'])->name('cart.store');
    //     Route::get('/cart', [CartController::class, 'index'])->name('cart');
    //     Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    //     Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    //     Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    //     Route::post('/vnpay_payment', [PaymentController::class, 'vnpay_payment']);
    //     Route::get('/vnpay/return', [PaymentController::class, 'vnpayReturn'])->name('vnpay.return');
    //     Route::post('/momo_payment', [PaymentController::class, 'momo_payment']);
    //     Route::post('/momoQr_payment', [PaymentController::class, 'momoQr_payment']);
    //     Route::get('/momo-callback', [PaymentController::class, 'momoCallback'])->name('momo.callback');
    // });

    // Route::get('/checkout', [PaymentController::class, 'checkout'])->name('checkout');
    // Route::post('/process-payment', [PaymentController::class, 'processPayment'])->name('payment.process');
    // Route::get('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
    // Route::get('/payment/failure', [PaymentController::class, 'paymentFailure'])->name('payment.failure');


});



// Giỏ hàng (yêu cầu đăng nhập)
Route::middleware('auth')->group(function () {
    Route::post('/account/update', [UserController::class, 'updateAccount'])->name('updateAccount');
    Route::post('products/{id}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('products/{id}/cart', [CartController::class, 'store'])->name('cart.store');
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::post('/vnpay_payment', [PaymentController::class, 'vnpay_payment']);
    Route::get('/vnpay/return', [PaymentController::class, 'vnpayReturn'])->name('vnpay.return');
    Route::post('/momo_payment', [PaymentController::class, 'momo_payment']);
    Route::post('/momoQr_payment', [PaymentController::class, 'momoQr_payment']);
    Route::get('/test-mail', function () {
        $order = Order::latest()->first();
        Mail::to('chinhbanh24@gmail.com')->send(new OrderConfirmationMail($order));
        return 'Mail đã gửi, kiểm tra hộp thư!';
    });
    Route::get('/momo-callback', [PaymentController::class, 'momoCallback'])->name('momo.callback');
    Route::post('/checkout/apply-voucher', [CartController::class, 'applyVoucher'])
        ->name('checkout.applyVoucher');
    Route::get('user/orders/{order}', [UserOrderController::class, 'show'])
        ->middleware('auth')
        ->name('user.order.detail');
    Route::post('user/orders/{id}/confirm-received', [UserOrderController::class, 'confirmReceived'])
        ->middleware('auth')
        ->name('orders.confirm-received');
    Route::post('user/orders/{order}/cancel', [UserOrderController::class, 'cancel'])->name('orders.cancel');
    Route::get('/change-password', [UserController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/change-password', [UserController::class, 'changePassword'])->name('password.update');
});

Route::get('/checkout', [PaymentController::class, 'checkout'])->name('checkout');
Route::post('/process-payment', [PaymentController::class, 'processPayment'])->name('payment.process');
Route::get('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment/failure', [PaymentController::class, 'paymentFailure'])->name('payment.failure');
Route::get('/top-favorite-products', [ProductController::class, 'topFavorites'])->name('products.topFavorites');
// Route::post('/checkout/apply-voucher', [CartController::class, 'apply'])->name('cart.apply');
// login with google
Route::get('google/login', [AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');
// forgot pasword
Route::get('forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');

Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ResetPasswordController::class, 'ResetPassword'])->name('password.update');
Route::get('/password-sent', function (Request $request) {
    return view('auth.passwordSent', ['email' => $request->email]);
})->name('password.sent');
