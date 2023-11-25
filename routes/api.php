<?php

use App\Http\Controllers\Api\ApiCategoryController;
use App\Http\Controllers\Api\ApiProductController;
use App\Http\Controllers\Api\ApiPostController;
use Illuminate\Support\Facades\Route;

//Public Api Routes
Route::apiResource('/posts',ApiPostController::class, ['only' => ['index', 'show']]);
Route::apiResource('/categories', ApiCategoryController::class, ['only' => ['index', 'show']]);

Route::match(['get', 'post'], '/products/search', [ApiProductController::class, 'index'])->name('api.products.search');