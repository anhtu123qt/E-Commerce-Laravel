<?php

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
// Frontend
Route::get('index','Frontend\HomeController@index')->name('homepage');
Route::get('detail/{id}','Frontend\HomeController@detail')->name('detail');
// Search
Route::post('search-ajax','Frontend\HomeController@search_ajax');
Route::get('search','Frontend\HomeController@search')->name('search');
Route::get('search-advanced','Frontend\HomeController@search_advanced')->name('search.advanced');
Route::post('search-adv','Frontend\HomeController@search_adv')->name('search_adv');
// Cart
Route::post('add-to-cart','Frontend\CartController@addToCart');
Route::get('show-cart','Frontend\CartController@showCart');
Route::post('update-cart-up-qty','Frontend\CartController@updateCartQtyUp');
Route::post('update-cart-down-qty','Frontend\CartController@updateCartQtyDown');
Route::get('delete-product','Frontend\CartController@deleteProduct');
// Member
Route::get('member','Frontend\MemberController@index')->name('member');
Route::post('member/register','Frontend\MemberController@register')->name('member.register');
Route::post('member/login','Frontend\MemberController@login')->name('member.login');
Route::get('member/account','Frontend\MemberController@account')->name('member.account');
Route::post('member/account/update','Frontend\MemberController@update_account')->name('member.update');
// Blog
Route::get('blog/list','Frontend\BlogController@list')->name('blog.list');
Route::get('blog/single/{id}','Frontend\BlogController@single')->name('blog.single');
Route::post('rating','Frontend\BlogController@saveRating')->name('blog.single.rating');
Route::post('load-cmt','Frontend\BlogController@load_cmt');
Route::post('add-cmt','Frontend\BlogController@add_cmt');
Route::post('add-reply','Frontend\BlogController@add_reply');
// Product
Route::resource('product',Frontend\ProductController::class)->middleware('auth.role');
Route::get('home', 'HomeController@index')->name('home');
// Login with FB
Route::get('member/facebook','Frontend\MemberController@redirectToFacebook')->name('login.facebook');
Route::get('member/facebook/callback','Frontend\MemberController@handleFacebookCallback');
//Login with Google
Route::get('member/google','Frontend\MemberController@redirectToGoogle')->name('login.google');
Route::get('member/google/callback','Frontend\MemberController@handleGoogleCallback');
//Forget Password
Route::get('forgot-password','Frontend\MemberController@forgot_password')->name('forgot_password');
Route::get('reset-password','Frontend\MemberController@reset_password')->name('reset_password');
Route::get('recovery-password','Frontend\MemberController@recovery_password')->name('recovery_password');
Route::get('update-password','Frontend\MemberController@update_password')->name('update_password');
// Coupon
Route::get('check-coupon','Frontend\CartController@checkCoupon')->name('checkCoupon');
Route::get('delete-cp','Frontend\CartController@delete_cp');
// Delivery fee
Route::post('check-out/address-ajax','Frontend\CartController@address_ajax')->name('address.ajax');
Route::post('check-out/calc-feeship-ajax','Frontend\CartController@calc_feeship_ajax');
Route::get('delete-feeship','Frontend\CartController@delete_feeship');
// Checkout - Sendmail
Route::get('check-out','Frontend\CartController@checkout')->name('checkout');
Route::post('send-mail','Frontend\CartController@sendmail')->name('sendmail');
Route::get('paypal','Frontend\CartController@paypal');
Route::get('thanks','Frontend\CartController@thanks');
Auth::routes();

// Backend

// Dasboard
Route::get('dashboard','Admin\DashboardController@show_dashboard');
// User
Route::get('user','Admin\UserController@user')->name('user');
Route::get('user/edit','Admin\UserController@edit')->name('user.edit');
Route::post('user/edit','Admin\UserController@update')->name('user.update');
// Country
Route::resource('country',Admin\CountryController::class);
// Blog
Route::resource('blog',Admin\BlogController::class);
// Category
Route::resource('category',Admin\CategoryController::class);
// Brand
Route::resource('brand',Admin\BrandController::class);
Route::group(['middleware'=> 'auth.role'], function(){
    //Authorization
    Route::get('user_manager','Admin\UserController@user_manager')->name('user_manager');
    Route::post('assign-role','Admin\UserController@assign_role')->name('assign_role');
    Route::get('delete-user-role/{id}','Admin\UserController@delete_user_role')->name('delete_user_role');
    Route::resource('coupon',Admin\CouponController::class);
    Route::get('delivery-manager','Admin\DeliveryController@delivery')->name('delivery');
    Route::post('address-ajax','Admin\DeliveryController@address_ajax');
    Route::post('add-feeship','Admin\DeliveryController@add_feeship');
    Route::post('feeship-ajax','Admin\DeliveryController@feeship_ajax');
    Route::post('update-feeship','Admin\DeliveryController@update_feeship');
    // Order History
    Route::get('order-history','Admin\OrderController@orderHistory');
    Route::get('order-detail/{id}','Admin\OrderController@orderDetail');
    Route::post('order-detail/update-order-status','Admin\OrderController@update_orderStatus')->name('update.order_status');
});



