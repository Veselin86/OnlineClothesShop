<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Models\Category;
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

/* Route::get('/', function () {
    return view('welcome');
}); */
Route::get('/', HomeController::class)->name('home');

Route::resource('/users', UserController::class)->names('users');
Route::resource('/addresses', AddressController::class)->names('addresses');
Route::resource('/providers', ProviderController::class)->names('providers');
Route::resource('categories', CategoryController::class)->names('categories');
Route::resource('/products', ProductController::class)->names('products');
Route::get('/products/category/{categoryId}', [ProductController::class, 'index'])->name('products.index.category');

/* Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.id'); */
Route::resource('/sales', SaleController::class)->names('sales');

Route::get('/category/{id}/products', [CategoryController::class, 'getProducts'])->name('category.products');

