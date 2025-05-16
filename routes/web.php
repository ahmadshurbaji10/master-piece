<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Vendor\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::post('/cart/apply-coupon', [CartController::class, 'applyCoupon'])->name('cart.applyCoupon');

Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function () {
    Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);
});

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::resource('coupons', \App\Http\Controllers\Admin\CouponController::class);
});


Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::get('/orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [\App\Http\Controllers\Admin\OrderController::class, 'show'])->name('orders.show');
});
Route::patch('/admin/orders/{order}/status', [\App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');

Route::post('/cart/set/{id}', [CartController::class, 'setQuantity'])->name('cart.set');


Route::get('/admin/profile', function () {
    return view('admin.profile', ['user' => auth()->user()]);
})->name('admin.profile')->middleware('auth');

Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

Route::post('/cart/add-ajax', [CartController::class, 'addAjax'])->name('cart.addAjax');

use App\Http\Controllers\HomeController;

Route::get('/home', [HomeController::class, 'index'])->name('home');


use App\Http\Controllers\ShopController;

// عرض كل المنتجات
Route::get('/shop', [ShopController::class, 'index'])->name('shop');

// عرض تفاصيل منتج
Route::get('/shop/{product}', [ShopController::class, 'show'])->name('shop.show');

// Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::post('/shop/{product}/review', [ReviewController::class, 'store'])->name('shop.review');


Route::get('/', function () {
    return view('welcome');
});

// Route::get('/home', function () {
//     return view('home');
// });

Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.form');
Route::post('/contact', [ContactController::class, 'submitForm'])->name('contact.submit');

Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::post('/reviews/store', [ReviewController::class, 'store'])->name('reviews.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/products/{product}/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/products/{product}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
});

// Route::get('/customer/dashboard', [CustomerController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('customer.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/redirect', function () {
    $role = auth()->user()->role;

    return match ($role) {
        'admin' => redirect()->route('admin.dashboard'),
        'vendor' => redirect()->route('vendor.dashboard'),
        default => redirect()->route('customer.dashboard'),
    };
});


// Admin Dashboard
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

// Vendor Dashboard
Route::middleware(['auth', 'role:vendor'])->group(function () {
    Route::get('/vendor/dashboard', function () {
        return view('vendor.dashboard');
    })->name('vendor.dashboard');
});


// web.php
Route::get('/customer/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
Route::put('/customer/profile', [CustomerController::class, 'updateProfile'])->name('customer.profile.update');
Route::post('/customer/order/{product}', [CustomerController::class, 'orderProduct'])->name('customer.order');




Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/checkout', [CartController::class, 'checkoutPage'])->name('cart.checkoutPage');
// Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout.process');

Route::post('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');

// Route::prefix('cart')->middleware('auth')->group(function () {
//     Route::get('/', [CartController::class, 'index'])->name('cart.index');
//     Route::post('/add/{product}', [CartController::class, 'add'])->name('cart.add');
//     Route::delete('/remove/{item}', [CartController::class, 'remove'])->name('cart.remove');
// });





// Route::prefix('cart')->middleware('auth')->group(function () {
//     Route::get('/', [CartController::class, 'index'])->name('cart.index');
//     Route::post('/add/{product}', [CartController::class, 'add'])->name('cart.add');
//     Route::delete('/remove/{item}', [CartController::class, 'remove'])->name('cart.remove');
//     Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
// });

// Customer Dashboard
// Route::middleware(['auth', 'role:customer'])->group(function () {
//     Route::get('/customer/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
// });

Route::post('/cart/add/{product}', [App\Http\Controllers\CartController::class, 'add'])->name('cart.add');



// use App\Http\Controllers\CartController;

// Route::middleware(['auth', 'role:customer'])->group(function () {
//     Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
//     Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
//     Route::post('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
// });

// Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');


// Route::post('/cart/update/{product}', [App\Http\Controllers\CartController::class, 'update'])->name('cart.update');


// Route::middleware(['auth', 'role:customer'])->group(function () {
//     Route::get('/checkout', [CartController::class, 'checkoutPage'])->name('checkout.page');
//     Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout.process');
// });
// Route::get('customer/orders/{order}', [OrderController::class, 'show'])
//     ->name('customer.orders.show');

    Route::get('/customer/orders/{order}', [CustomerController::class, 'showOrder'])->name('customer.orders.show');



Route::middleware(['auth', 'role:vendor'])->group(function () {
    Route::get('/vendor/dashboard', [\App\Http\Controllers\VendorController::class, 'dashboard'])->name('vendor.dashboard');
});


use App\Http\Controllers\ProductController;

Route::middleware(['auth', 'role:vendor'])->prefix('vendor')->name('vendor.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\VendorController::class, 'dashboard'])->name('dashboard');

    // Product Management Routes
    Route::resource('products', ProductController::class)->except(['show']);
});

use App\Http\Controllers\Auth\RegisteredUserController;

Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest');


    Route::middleware(['auth', 'role:vendor'])->prefix('vendor')->name('vendor.')->group(function () {
        Route::resource('products', ProductController::class);
    });



    // ✅ Group routes for Admin only
    Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {

        // Dashboard
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // Manage Products
        Route::resource('products', ProductController::class);

        // Manage Users
        Route::resource('users', UserController::class);
    });




    use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;


    Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/users', [AdminController::class, 'users'])->name('users.index');

        // 🔽 راوتات المنتجات الكاملة
        Route::get('/products', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('products.index');
        Route::get('/products/create', [\App\Http\Controllers\Admin\ProductController::class, 'create'])->name('products.create'); // ✅ حل المشكلة
        Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');
        Route::get('/products/{product}', [\App\Http\Controllers\Admin\ProductController::class, 'show'])->name('products.show');
        Route::get('/products/{product}/edit', [\App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [\App\Http\Controllers\Admin\ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [\App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('products.destroy');
    });


    // Route::post('/products/{product}/reviews', [App\Http\Controllers\ReviewController::class, 'store'])->name('products.reviews.store');



    use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\VendorController;

    Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
Route::get('discounts', [DiscountController::class, 'index'])->name('discounts.index');
Route::get('discounts/create', [DiscountController::class, 'create'])->name('discounts.create');
Route::post('discounts', [DiscountController::class, 'store'])->name('discounts.store');
Route::get('discounts/{discount}/edit', [DiscountController::class, 'edit'])->name('discounts.edit');
Route::put('discounts/{discount}', [DiscountController::class, 'update'])->name('discounts.update');
Route::delete('discounts/{discount}', [DiscountController::class, 'destroy'])->name('discounts.destroy');
    });


    // Route::prefix('vendor')->middleware(['auth', 'role:vendor'])->name('vendor.')->group(function () {
    //     Route::resource('orders', \App\Http\Controllers\Vendor\OrderController::class)->only(['index']);
    // });


    Route::middleware(['auth', 'role:vendor'])->prefix('vendor')->name('vendor.')->group(function () {
        Route::get('/account', [VendorController::class, 'account'])->name('account');
        Route::get('/account/edit', [VendorController::class, 'editAccount'])->name('account.edit');
        Route::post('/account/update', [VendorController::class, 'updateAccount'])->name('account.update');
    });

    Route::middleware(['auth', 'role:vendor'])->prefix('vendor')->name('vendor.')->group(function () {
        Route::get('/dashboard', [VendorController::class, 'dashboard'])->name('dashboard');

        // الحساب الشخصي
        Route::get('/account', [VendorController::class, 'account'])->name('account');
        Route::post('/account/update', [VendorController::class, 'updateAccount'])->name('account.update');
    });

    Route::get('/about', function () {
        return view('about');
    })->name('about');


    Route::get('/contact', function () {
        return view('contact');
    })->name('contact');



