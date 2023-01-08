<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;

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


Route::get('/', function () {
    return view('home');
});


Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Route::get('/profile', [HomeController::class, 'userProfile'])->name('user.home');

Route::get('/seller', [HomeController::class, 'sellerHome'])->name('seller.home')->middleware('is_seller');

Route::get("/detail/{id}", [ProductController::class, 'detail']);

Route::get("/search", [ProductController::class, 'search'])->name('search');

Route::get("/cart", [ProductController::class, 'cart'])->name('cart');

Route::post("/addToCart", [ProductController::class, 'addToCart'])->name('addToCart');

Route::get("/removeFromCart/{id}", [ProductController::class, 'removeFromCart'])->name('remove_cart');


Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');

    Route::get("/admin/allUsers", [AdminController::class, 'allUsers'])->name('admin.allUsers');

    Route::get("/admin/allCategories", [AdminController::class, 'allCategories'])->name('admin.allCategories');

    Route::get("/admin/allItems", [AdminController::class, 'allItems'])->name('admin.allItems');
    
    Route::post("admin/addCat", [AdminController::class, 'addCat'])->name('admin.addCat');
    
    Route::get("admin/deleteCat/{id}", [AdminController::class, 'deleteCat'])->name('admin.deleteCat');
    
    Route::get("admin/editCat/{id}", [AdminController::class, 'editCat'])->name('admin.editCat');
    
    Route::put("admin/updateCat/{id}", [AdminController::class, 'updateCat'])->name('admin.updateCat');

});
