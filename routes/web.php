<?php

use Dompdf\Dompdf;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Mail\OrderConfirmed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;

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


Route::get("categories", [HomeController::class, 'categories'])->name('categories');

Route::get("categories/{id}", [HomeController::class, 'categoriesid'])->name('categoriesid');

Route::get("allProducts", [HomeController::class, 'allproducts'])->name('allproducts');

Auth::routes([
    'verify' => true
]);

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');

Route::get('/profile', [HomeController::class, 'userProfile'])->name('user.home');

Route::get("/detail/{id}", [ProductController::class, 'detail'])->name('detail');

Route::get("/search", [ProductController::class, 'search'])->name('search');

Route::get("/cart", [ProductController::class, 'cart'])->name('cart');

Route::post("/addToCart", [ProductController::class, 'addToCart'])->name('addToCart');

Route::get("/removeFromCart/{id}", [ProductController::class, 'removeFromCart'])->name('remove_cart');

Route::get("/about", [HomeController::class, 'about'])->name('about');

Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home');

    Route::get("admin/allUsers", [AdminController::class, 'allUsers'])->name('admin.allUsers');

    Route::get("admin/allCategories", [AdminController::class, 'allCategories'])->name('admin.allCategories');

    Route::get("admin/allItems", [AdminController::class, 'allItems'])->name('admin.allItems');
    
    Route::post("admin/addCat", [AdminController::class, 'addCat'])->name('admin.addCat');
    
    Route::get("admin/deleteCat/{id}", [AdminController::class, 'deleteCat'])->name('admin.deleteCat');
    
    Route::get("admin/editCat/{id}", [AdminController::class, 'editCat'])->name('admin.editCat');
    
    Route::put("admin/updateCat/{id}", [AdminController::class, 'updateCat'])->name('admin.updateCat');

    Route::get("admin/deleteItem/{id}", [AdminController::class, 'deleteItem'])->name('admin.deleteItem');
    
    Route::get("admin/editItem/{id}", [AdminController::class, 'editItem'])->name('admin.editItem');
    
    Route::put("admin/updateItem/{id}", [AdminController::class, 'updateItem'])->name('admin.updateItem');

    Route::post("admin/addUser", [AdminController::class, 'addUser'])->name('admin.addUser');

    Route::get("admin/deleteUser/{id}", [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
    
    Route::get("admin/editUser/{id}", [AdminController::class, 'editUser'])->name('admin.editUser');
    
    Route::put("admin/updateUser/{id}", [AdminController::class, 'updateUser'])->name('admin.updateUser');

});

Route::middleware(['auth', 'is_seller'])->group(function () {
    Route::get('seller/home', [HomeController::class, 'sellerHome'])->name('seller.home');

    Route::get("seller/allItems", [SellerController::class, 'allItems'])->name('seller.allItems');

    Route::get("seller/deleteItem/{id}", [SellerController::class, 'deleteItem'])->name('seller.deleteItem');

    Route::get("seller/editItem/{id}", [SellerController::class, 'editItem'])->name('seller.editItem');

    Route::put("seller/updateItem/{id}", [SellerController::class, 'updateItem'])->name('seller.updateItem');

    Route::post("seller/addItem", [SellerController::class, 'addItem'])->name('seller.addItem');

});

Route::group(array('before' => 'auth'), function () {
    Route::get("checkout", [CheckoutController::class, 'index'])->name('checkout');

    Route::post("checkout/payment", [CheckoutController::class, 'placeOrder'])->name('placeOrder');

    Route::get("sendMail", function () {

        $data["name"] = User::where('id', '=', Auth::id())->value('name');
        $data["email"] = User::where('id', '=', Auth::id())->value('email');
        $data["subject"] = 'Order Confirmed';
        $data["body"] = '<body>Order Confirmed</body>';

        $dompdf = new Dompdf();
        $html = "<p><h1>thank you ".$data["name"]."!</h1></p>
        <p>Your order was received!</p>";
        $dompdf->loadHtml($html);
        $dompdf->render();

        $pdf = $dompdf->output();
        $data["pdf"] = "OrderConfirmed.pdf";
        file_put_contents('OrderConfirmed.pdf', $pdf);
            /*Mail::send([], $data, function ($message) use ($data, $pdf) {
                $message->to($data["email"], $data["name"])
                    ->subject($data["subject"])
                    ->
                    ->attachData($pdf, 'OrderConfirmed.pdf');
            }
            );*/
        Mail::to($data["email"])->send(new OrderConfirmed($data["name"], $data["pdf"]));
    }
    )->name('sendMail');
});

