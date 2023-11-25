<?php

use App\Http\Controllers\Api\ApiProductController;
use Illuminate\Support\Facades\Route;

//Public Api Routes

Route::match(['get', 'post'], '/products/search', [ApiProductController::class, 'index'])->name('api.products.search');