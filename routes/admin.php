<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;

Route::middleware(['auth', 'can:admin-login'])->name('admin.')->prefix('/admin')->group(function () {
    // This Roles can manage with Admin & Writers with specific policies.
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/product/search', [ProductController::class, 'search'])->name('product.search');
    Route::resources([
        'product' => ProductController::class,
    ]);
    Route::resource('/account', AccountController::class, ['only' => ['index', 'update']]);
    // Special To Admin Role Only
    Route::middleware(['can:admin-only'])->group(function () {
        Route::get('/page/slug-get', [PageController::class, 'getSlug'])->name('page.getslug');
        Route::resource('/user', UserController::class, ['except' => ['create', 'store', 'show']]);
        Route::resource('/page', PageController::class);
        Route::resource('/role', RoleController::class, ['only' => ['index']]);
        Route::resource('/setting', SettingController::class, ['only' => ['index', 'update']]);
    });
});
