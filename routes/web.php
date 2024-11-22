<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DiscountController;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', function () {
        return redirect('/products');
    });

    Route::get('/products', function () {
        return Inertia::render('Products');
    })->name('products');

    Route::get('/product/{product}', [ProductController::class, 'get'])->name('products.view');
    Route::get('/products/list', [ProductController::class, 'list'])->name('products.list');
    Route::get('/discounts/list', [DiscountController::class, 'list'])->name('discounts.list');
});

