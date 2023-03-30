<?php

use App\Http\Middleware\CheckLoginUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LayoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\CheckLogin;
use App\Http\Middleware\Checkout;
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


// Giao dien


Route::get('/', [LayoutController::class, 'index'])->name('home');
Route::get('/product', [LayoutController::class, 'product'])->name('product');
Route::get('/product-detail/{product}', [LayoutController::class, 'productDetail'])->name('product-detail');
Route::post('/product_detail',[LayoutController::class, 'update_qty_ajax'])->name('update-quantity-cart');
// Route::get('/product-detail/{product}',[LayoutController::class, 'update_quanlity'])->name('update-quanlity');

Route::get('/cart', [LayoutController::class, 'cart'])->name('cart');
Route::post('/cart', [LayoutController::class, 'save_cart'])->name('save-cart');

Route::get('/update-qty', [LayoutController::class, 'update_qty'])->name('update-qty');

Route::get('/cart/delete/{rowId}', [LayoutController::class, 'delete_cart'])->name('delete-cart');
Route::get('/cart/update/{id}/{quantity}', [LayoutController::class, 'update_cart'])->name('update-cart');

Route::group(['middleware' => Checkout::class], function(){

    Route::get('/checkout', [LayoutController::class, 'checkout'])->name('checkout');
    Route::post('/checkout', [LayoutController::class, 'save_checkout'])->name('save-checkout');
    Route::post('/check-coupon',[LayoutController::class, 'check_coupon'])->name('check-coupon');
    Route::get('/unset-coupon',[LayoutController::class, 'unset_coupon'])->name('unset-coupon');
    
    // check coupon
    Route::get('/checkout/processdistrict', [LayoutController::class, 'processdistrict'])->name('processdistrict');
    Route::get('/checkout/processward', [LayoutController::class, 'processward'])->name('processward');

    // payment online
    Route::get('/vnpay-return', [LayoutController::class, 'vnpay_return'])->name('vnpay-return');

});

//sent mail
// Route::get('/send-mail', [LayoutController::class, 'send_mail'])->name('send-mail');

Route::get('/choice',[LayoutController::class, 'choice'])->name('choice');


Route::get('/blog', [LayoutController::class, 'blog'])->name('blog');
Route::get('/blog-detail', [LayoutController::class, 'blogDetail'])->name('blog-detail');
Route::get('/contact', [LayoutController::class, 'contact'])->name('contact');
Route::get('/about', [LayoutController::class, 'about'])->name('about');


Route::get('/register', [LayoutController::class, 'register'])->name('register');
Route::post('/register', [LayoutController::class, 'store'])->name('store');

Route::get('/logout', [LayoutController::class, 'logout'])->name('logout');

// User
Route::group(['middleware' => CheckLoginUser::class], function () {
    Route::get('/login', [LayoutController::class, 'login'])->name('login');
    Route::post('/login', [LayoutController::class, 'process_login'])->name('process-login');

    // Admin
    Route::group(['middleware'=> CheckLogin::class],function(){
            
        Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin-logout');
    
        Route::get('/admin/process-page',[AdminController::class, 'process_page'])->name('admin-process-page');
        Route::get('admin/process-page-hot',[AdminController::class, 'process_page_product_hot'])->name('admin-process-page-product-hot');
    
        Route::get('/admin/search',[AdminController::class, 'search'])->name('admin-search');
    
        Route::get('/admin/product', [AdminController::class, 'product'])->name('admin-product');
        Route::get('/admin/product/hot', [AdminController::class, 'product_hot'])->name('admin-product-hot');
        Route::get('/admin/product/soldout', [AdminController::class, 'product_soldout'])->name('admin-product-soldout');
    
        Route::get('/admin/product/add', [AdminController::class, 'productAdd'])->name('admin-product-add');
        Route::post('/admin/product/add', [AdminController::class, 'productStore'])->name('admin-product-store');
    
        Route::get('/admin/product/edit/{product}', [AdminController::class, 'productEdit'])->name('admin-product-edit');
        Route::put('/admin/product/edit/{product}', [AdminController::class, 'productUpdate'])->name('admin-product-update');
    
        Route::delete('/admin/product/delete/{product}', [AdminController::class, 'productDelete'])->name('admin-product-delete');
    
        Route::get('/admin/charts', [AdminController::class, 'charts'])->name('admin-charts');
        Route::get('/admin/user', [AdminController::class, 'user'])->name('admin-user');
        Route::get('/admin/user/add', [AdminController::class, 'userAdd'])->name('admin-user-add');
        Route::get('/admin/user/edit', [AdminController::class, 'userEdit'])->name('admin-user-edit');
        Route::get('/admin/user/delete', [AdminController::class, 'userDelete'])->name('admin-user-delete');
        Route::get('/admin/order', [AdminController::class, 'order'])->name('admin-order');
    
        Route::get('admin/order/process-page-order',[AdminController::class, 'process_page_order'])->name('admin-process-page-order');
    
        Route::get('/admin/order-detail/{order}', [AdminController::class, 'orderDetail'])->name('admin-order-detail');
        Route::post('/admin/order-detail/{order}', [AdminController::class, 'orderDetailUpdate'])->name('admin-order-detail-update');
        Route::get('/admin/order/add', [AdminController::class, 'orderAdd'])->name('admin-order-add');
        Route::get('/admin/order/edit', [AdminController::class, 'orderEdit'])->name('admin-order-edit');
        Route::get('/admin/order/delete', [AdminController::class, 'orderDelete'])->name('admin-order-delete');
    
        Route::get('/admin/404', [AdminController::class, 'error404'])->name('admin-404');
        Route::get('/admin/insert-coupon',[AdminController::class, 'insert_coupon'])->name('admin-insert-coupon');
        Route::post('admin/insert-coupon',[AdminController::class, 'store_coupon'])->name('admin-store-coupon');
        Route::get('admin/list-coupon',[AdminController::class, 'list_coupon'])->name('admin-list-coupon');
        Route::delete('/admin/delete-coupon/{coupon}',[AdminController::class, 'delete_coupon'])->name('admin-delete-coupon');
        Route::get('/admin', [AdminController::class, 'index'])->name('admin-home');

    });
    
});



Route::get('/admin/login', [AdminController::class, 'login'])->name('admin-login');
Route::post('/admin/login', [AdminController::class, 'process_login'])->name('admin-process-login');
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin-logout');

Route::get('/admin/register', [AdminController::class, 'register'])->name('admin-register');

Route::post('/admin/register', [AdminController::class, 'store'])->name('admin-store');

