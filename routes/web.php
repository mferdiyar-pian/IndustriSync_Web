<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IntegrationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/locale', [App\Http\Controllers\SettingController::class, 'updateLocale'])->name('settings.locale');

Route::middleware(['auth'])->group(function () {
    // Shared Settings
    Route::get('/settings', [App\Http\Controllers\SettingController::class, 'index'])->name('settings.index');

    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    
    Route::middleware('role:user')->prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\User\DashboardController::class, 'index'])->name('dashboard');
        
        // Products
        Route::get('/products', [App\Http\Controllers\User\ProductController::class, 'index'])->name('products.index');
        Route::get('/products/{product}', [App\Http\Controllers\User\ProductController::class, 'show'])->name('products.show');
        
        // Wishlist
        Route::get('/wishlist', [App\Http\Controllers\User\WishlistController::class, 'index'])->name('wishlist.index');
        Route::post('/wishlist/{product}/toggle', [App\Http\Controllers\User\WishlistController::class, 'toggle'])->name('wishlist.toggle');
        
        // Cart
        Route::get('/cart', [App\Http\Controllers\User\CartController::class, 'index'])->name('cart.index');
        Route::post('/cart/add/{product}', [App\Http\Controllers\User\CartController::class, 'add'])->name('cart.add');
        Route::post('/cart/update', [App\Http\Controllers\User\CartController::class, 'update'])->name('cart.update');
        Route::post('/cart/remove', [App\Http\Controllers\User\CartController::class, 'remove'])->name('cart.remove');
        Route::post('/cart/clear', [App\Http\Controllers\User\CartController::class, 'clear'])->name('cart.clear');

        // Transactions
        Route::get('/transactions', [App\Http\Controllers\User\TransactionController::class, 'index'])->name('transactions.index');
        Route::get('/transactions/create', [App\Http\Controllers\User\TransactionController::class, 'create'])->name('transactions.create');
        Route::post('/transactions', [App\Http\Controllers\User\TransactionController::class, 'store'])->name('transactions.store');
        Route::get('/transactions/{transaction}', [App\Http\Controllers\User\TransactionController::class, 'show'])->name('transactions.show');
        



    });

    // Admin/Staff Routes (Existing)
    Route::middleware('role:admin,owner,staff')->group(function () {
        Route::resource('products', ProductController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('transactions', TransactionController::class);
        Route::get('transactions/{transaction}/invoice', [TransactionController::class, 'invoice'])->name('transactions.invoice');
        Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('reports/export', [ReportController::class, 'export'])->name('reports.export');
        
        // Marketplace Integrations
        Route::get('integrations', [IntegrationController::class, 'index'])->name('integrations.index');
        Route::get('integrations/shopee', [IntegrationController::class, 'shopee'])->name('integrations.shopee');
        Route::post('integrations/shopee/sync', [IntegrationController::class, 'shopeeSync'])->name('integrations.shopee.sync');
    });
    
    // Admin Only
    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class);
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
