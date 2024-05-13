<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Product\ProductAttributeController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SupplierController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
});
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('products', ProductController::class);
    Route::resource('purchases', PurchaseController::class);
    // Route::resource('sales', SaleController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('product-attributes', [ProductAttributeController::class, 'index'])->name('product.attributes.index');
    Route::post('product-categories', [ProductAttributeController::class, 'storeCategory'])->name('product.categories.store');
    Route::post('product-types', [ProductAttributeController::class, 'storeType'])->name('product.types.store');
    Route::put('product-categories/{productCategory}', [ProductAttributeController::class, 'updateCategory'])->name('product.categories.update');
    Route::put('product-types/{productType}', [ProductAttributeController::class, 'updateType'])->name('product.types.update');
    Route::delete('product-categories/{productCategory}', [ProductAttributeController::class, 'destroyCategory'])->name('product.categories.destroy');
    Route::delete('product-types/{productType}', [ProductAttributeController::class, 'destroyType'])->name('product.types.destroy');
});

// Route::group(['middleware' => ['role:Super Admin| Admin']], function () {
//     Route::resource('roles', RoleController::class);
//     Route::resource('users', UserController::class);
// });

// Route::group(['middleware' => ['role:super-admin|writer']], function () {
//     //
// });

// Route::group(['middleware' => ['permission:publish articles|edit articles']], function () {
//     //
// });

// routes/web.php


require __DIR__.'/auth.php';
