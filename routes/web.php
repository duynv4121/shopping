<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DanhMucController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductLayout;
use App\Http\Controllers\imageDetailController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\orderManager;
use App\Http\Controllers\couponController;


//fe
Route::get('/', [ProductLayout::class, 'index']);
Route::get('product-detail/{id}', [ProductLayout::class, 'detail']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/postLogin', [LoginController::class, 'login']);
Route::post('/search', [ProductLayout::class, 'search']);
//login facebook
Route::get('login/facebook', [LoginController::class, 'facebookRedirect']);
Route::get('login/facebook/callback', [LoginController::class, 'loginWithFacebook']);


//cart
Route::post('/addToCart/{id}', [CartController::class, 'addCart']);
Route::get('/shopping-cart', [CartController::class, 'getCart']);
Route::get('/delete/{id}', [CartController::class, 'remove']);
Route::post('/update', [CartController::class, 'update']);

Route::post('/checkout', [CartController::class, 'checkout']);



//admin
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index']);
    Route::resource('danh-muc', DanhMucController::class);
    //product
    Route::resource('product', ProductController::class);
    Route::get('add-attr', [ProductController::class, 'createAttr']);
    Route::post(' insert-attr', [ProductController::class, 'insert']);
    

    //ảnh chi tiết cho sản phẩm
    Route::get('createImg/{id}', [imageDetailController::class, 'create']);
    Route::post('storeImg/{id}', [imageDetailController::class, 'store']);
    Route::post('updateImgDetail', [imageDetailController::class, 'update']);
    Route::delete('deleteImg/{id}', [imageDetailController::class, 'destroy']);


    //mã giảm giá
    Route::resource('coupon', couponController::class);
});
//check-coupon
Route::post('check-coupon', [CartController::class, 'checkCoupon']);


//đơn hàng
Route::get('order-manager', [orderManager::class, 'index']);
Route::get('order-detail/{id}', [orderManager::class, 'orderDetail']);






