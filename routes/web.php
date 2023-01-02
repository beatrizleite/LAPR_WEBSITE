<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

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

Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');

Route::get("/detail/{id}", [ProductController::class, 'detail']);

Route::get("/search", [ProductController::class, 'search'])->name('search');

//Route::post("/cart", [ProductController::class, 'cart']);

Route::post("/addToCart", [ProductController::class, 'addToCart'])->name('addToCart');

