<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CounponController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Client\ProductController as ClientProductController;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// route client
Route::get('/', [HomeController::class, 'index'])->name('client.home');


Route::get('product/{category_id}', [ClientProductController::class, 'index'])->name('client.products.index');
Route::get('product-detail/{id}', [ClientProductController::class, 'show'])->name('client.products.show');



Auth::routes();


// route admin
Route::middleware('auth')->group(function(){

    Route::get('/dashboard', function () {
        return view('admin.dashboard.index');
    })->name('dashboard');

      // Route::resource('roles', RoleController::class);
      Route::prefix('roles')->controller(RoleController::Class)->name('roles.')->group(function(){
        Route::get('/', 'index')->name('index')->middleware('role:super-admin');
        Route::post('/', 'store')->name('store')->middleware('role:super-admin');
        Route::get('/create', 'create')->name('create')->middleware('role:super-admin');
        Route::get('/{coupon}', 'show')->name('show')->middleware('role:super-admin');
        Route::put('/{coupon}', 'update')->name('update')->middleware('role:super-admin');
        Route::delete('/{coupon}', 'destroy')->name('destroy')->middleware('role:super-admin');
        Route::get('/{coupon}/edit', 'edit')->name('edit')->middleware('role:super-admin');
    });
    // Route::resource('users', UserController::class);
    Route::prefix('users')->controller(UserController::Class)->name('users.')->group(function(){
        Route::get('/', 'index')->name('index')->middleware('permission:show-user');
        Route::post('/', 'store')->name('store')->middleware('permission:create-user');
        Route::get('/create', 'create')->name('create')->middleware('permission:create-user');
        Route::get('/{coupon}', 'show')->name('show')->middleware('permission:show-user');
        Route::put('/{coupon}', 'update')->name('update')->middleware('permission:update-user');
        Route::delete('/{coupon}', 'destroy')->name('destroy')->middleware('permission:delete-user');
        Route::get('/{coupon}/edit', 'edit')->name('edit')->middleware('permission:update-user');
    });
    // Route::resource('categories', CategoryController::class);
    Route::prefix('categories')->controller(CategoryController::Class)->name('categories.')->group(function(){
        Route::get('/', 'index')->name('index')->middleware('permission:show-category');
        Route::post('/', 'store')->name('store')->middleware('permission:create-category');
        Route::get('/create', 'create')->name('create')->middleware('permission:create-category');
        Route::get('/{coupon}', 'show')->name('show')->middleware('permission:show-category');
        Route::put('/{coupon}', 'update')->name('update')->middleware('permission:update-category');
        Route::delete('/{coupon}', 'destroy')->name('destroy')->middleware('permission:delete-category');
        Route::get('/{coupon}/edit', 'edit')->name('edit')->middleware('permission:update-category');
    });

    // Route::resource('products', ProductController::class);

    Route::prefix('products')->controller(ProductController::Class)->name('products.')->group(function(){
        Route::get('/', 'index')->name('index')->middleware('permission:show-product');
        Route::post('/', 'store')->name('store')->middleware('permission:create-product');
        Route::get('/create', 'create')->name('create')->middleware('permission:create-product');
        Route::get('/{coupon}', 'show')->name('show')->middleware('permission:show-product');
        Route::put('/{coupon}', 'update')->name('update')->middleware('permission:update-product');
        Route::delete('/{coupon}', 'destroy')->name('destroy')->middleware('permission:delete-product');
        Route::get('/{coupon}/edit', 'edit')->name('edit')->middleware('permission:update-product');
    });
    

});







