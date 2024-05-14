<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ExternalApi\GuzzleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Mail\InvoicesMailabel;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/* Route::get('/fetchProducts', [GuzzleController::class, 'fetchProducts']);
Route::get('/fetchCategories', [GuzzleController::class, 'fetchCategories']); */

Route::get('/external-categories', [GuzzleController::class, 'fetchCategories'])->name('external.categories');
Route::get('/external-products/{category}', [GuzzleController::class, 'fetchProducts'])->name('external.products.category');
Route::get('/external-product/{id}', [GuzzleController::class, 'show'])->name('external.product');
Route::post('/external-product', [GuzzleController::class, 'storeApiSell']);

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/register', function () {
    return view('users.register');
})->name('register');

Route::get('/login', function () {
    return view('users.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/products/{id}', [SaleController::class, 'store'])->middleware('check.stock');

Route::resource('/addresses', AddressController::class)->names('addresses');
Route::resource('/providers', ProviderController::class)->names('providers');
Route::resource('/categories', CategoryController::class)->names('categories');
Route::resource('/products', ProductController::class)->names('products');
Route::resource('/sales', SaleController::class)->names('sales');

Route::get('/products/category/{categoryId}', [ProductController::class, 'index'])->name('products.index.category');

Route::get('/category/{category}/products', [CategoryController::class, 'showProducts'])->name('category.products');

Route::post('/dashboard/update-phone', [UserController::class, 'updatePhone'])->name('user.update.phone');
Route::post('/dashboard/update-address', [UserController::class, 'updateAddress'])->name('user.update.address');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('users.dashboard');
    })->name('dashboard');
});

//Generando PDF con la factura
Route::get('/sales/{sale}/pdf', [SaleController::class, 'generatePDF'])->name('sales.pdf');

//Enviando correo electronico
Route::get('invoiceMail', function ( $saleId, $userId ) {

   $sale = Sale::find($saleId);
    $user = User::find($userId);

    Mail::to('info@fashionshop.com')
        ->send(new InvoicesMailabel($sale, $user));

    return "Email con invoce enviado";
    
})->name('invoiceMail');
