<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Frontend\frontendController;
use App\Http\Controllers\Admin\adminFrontendController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\RatingController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
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
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
//admin

Route::middleware(['auth','isAdmin'])->group(function(){
    //home

    Route::get('/dashboard',[adminFrontendController::class,'index']);

    //category

    Route::get('/categories',[CategoryController::class,'index']);
    Route::get('/add-category',[CategoryController::class,'add']);
    Route::post('/insert-category',[CategoryController::class,'insert']);
    Route::get('/edit-category/{id}',[CategoryController::class,'edit']);
    Route::put('/update-category/{id}',[CategoryController::class,'update']);
    Route::get('/delete-category/{id}',[CategoryController::class,'destroy']);
    
    //products

    Route::get('/products',[ProductController::class,'index']);
    Route::get('/add-product',[ProductController::class,'add']);
    Route::post('insert-product',[ProductController::class,'insert']);
    Route::get('/edit-product/{id}',[ProductController::class,'edit']);
    Route::put('/update-product/{id}',[ProductController::class,'update']);
    Route::get('/delete-product/{id}',[ProductController::class,'destroy']);

    //order

    Route::get('/orders',[OrderController::class,'index']);
    Route::get('/admin/view-order/{id}',[OrderController::class,'view']);
    Route::put('/update-order/{id}',[OrderController::class,'updateorder']);
    Route::get('order-history',[OrderController::class,'orderhistory']);
    Route::get('/view-invoice/{id}',[OrderController::class,'viewInvoice']);
    
    Route::get('/admin/view-order/download-invoice/{id}',[OrderController::class,'downloadInvoice']);

    //users
    Route::get('users',[DashboardController::class,'users']);
    Route::get('view-user/{id}',[DashboardController::class,'viewuser']);
    //slider
    Route::get('/slider',[SliderController::class,'index']);
    Route::get('/add-slider',[SliderController::class,'addSlider']);
    Route::post('/store-slider',[SliderController::class,'store']);
    Route::get('/delete-slider/{id}',[SliderController::class,'delete']);
    Route::get('/edit-slider/{id}',[SliderController::class,'edit']);
    Route::post('/update-slider/{id}',[SliderController::class,'update']);

});
//frontend  
Route::get('/',[FrontendController::class,'index']);
Route::get('/category',[FrontendController::class,'category']);
Route::get('/view-category/{slug}',[FrontendController::class,'viewCategory']);
Route::get('/category/{cate_slug}/{prod_slug}',[frontendController::class,'productView']);
Route::get('/product-list',[FrontendController::class,'productlistAjx']);
Route::post('/searchproduct',[FrontendController::class,'searchProduct']);
//cart
Route::post('/add-to-cart',[CartController::class,'addProduct']);
Route::post('/delete-cart-item',[CartController::class,'deleteProduct']);
Route::post('/update-quantity',[CartController::class,'updateQuantity']);
//wishlist
Route::post('/add-to-wishist',[WishlistController::class,'add']);
//delete-wishlist
Route::post('/delete-wishlist-item',[WishlistController::class,'deleteItem']);
//load cart data 
Route::get('/load-cart-data',[CartController::class,'cartcount']);
//load-wishlist-data
Route::get('/load-wishlist-data',[WishlistController::class,'wishlistcount']);
Route::middleware(['auth'])->group(function(){
    Route::get('cart',[CartController::class,'viewCart']);
    Route::get('cart/checkout',[CheckoutController::class,'index']);
    Route::post('place-order',[CheckoutController::class,'placeorder']);
    Route::get('my-orders',[UserController::class,'index']);
    Route::get('view-order/{id}',[UserController::class,'view']);
    //wishlist
    Route::get('/wishlist',[WishlistController::class,'index']);
    //proceed to pay 
    Route::post('/proceed-to-pay',[CheckoutController::class,'proceedToPay']);
    //rating
    Route::post('/add-rating',[RatingController::class,'add']);
    //review
    Route::get('/add-review/{product_slug}/userreview',[ReviewController::class,'add']);
    Route::post('/add-review',[ReviewController::class,'create']);
    Route::get('edit-review/{product_slug}/userreview',[ReviewController::class,'edit']);;
    Route::put('/update',[ReviewController::class,'update']);
});


// SSLCOMMERZ Start



Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END
