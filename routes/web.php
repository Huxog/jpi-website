<?php

use Illuminate\Support\Facades\Route;

// Redirect root to default language
Route::get('/', function () {
    return redirect('/' . config('brand.default_language'));
});

// Language-prefixed routes
Route::prefix('{locale}')->group(function () {

    Route::get('/', function () {
        return view('home');
    })->name('home');

    Route::get('/categories', function () {
        return view('categories');
    })->name('categories');

    Route::get('/products', function () {
        $category = request('category', 'tools');
        return view('products', compact('category'));
    })->name('products');

});
