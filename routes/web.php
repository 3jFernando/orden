<?php

use Illuminate\Support\Facades\Route;

// controladores
use App\Http\Controllers\{
    ContactController,
    SaleController, 
    ProductController,
    ShopController,
    PurchaseController,
    HomeController
};
use App\Http\Controllers\Api\v1\{
    ProductController as ApiProductController,
    HomeController as ApiHomeController,
};

Route::get('/', [HomeController::class, 'index'])->name('admin.index');

Route::group(['middleware' => 'auth'], function() {

    // tienda
    Route::get('/shops/{shop}/edit', [ShopController::class, 'edit'])->name('shops.edit');

    // ventas
    Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');
    Route::get('/sales/create', [SaleController::class, 'create'])->name('sales.create');
    Route::post('/sales', [SaleController::class, 'store'])->name('sales.store');
    Route::get('/sales/{sale}', [SaleController::class, 'show'])->name('sales.show');

    // productos
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    // contactos
    Route::get('/contacts.index', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/create', [ContactController::class, 'create'])->name('contacts.create');
    Route::get('/contacts/{contact}', [ContactController::class, 'edit'])->name('contacts.edit');
    Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
    Route::put('/contacts/{contact}', [ContactController::class, 'update'])->name('contacts.update');
    Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');

    // compras
    Route::get('/purchases', [PurchaseController::class, 'index'])->name('purchases.index');
    Route::get('/purchases/create', [PurchaseController::class, 'create'])->name('purchases.create');
    Route::get('/purchases/{purchase}', [PurchaseController::class, 'show'])->name('purchases.show');
    Route::post('/purchases', [PurchaseController::class, 'store'])->name('purchases.store');

    /**
     * API
     * version: v1
     */
    Route::group(['prefix' => 'api/v1'], function() {

        // filtros home
        Route::post('/home-filters', [ApiHomeController::class, 'home'])->name('admin.filtersHome');

        // productos
        Route::get('/products', [ApiProductController::class, 'load'])->name('products.load');
        Route::post('/products/search', [ApiProductController::class, 'search'])->name('products.search');


    });

});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');