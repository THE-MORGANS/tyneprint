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

Route::domain('dashboard.tyneprints.com')->group(function(){
    Route::post('/manage/user/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->middleware('auth:admin')->name('admin.index');
    Route::get('/login', 'Auth\AdminLoginController@showLogin')->name('admin-login');
    Route::get('/index', 'AdminController@index')->name('admin.index')->middleware('auth:admin');
    Route::middleware('auth:admin')->group( function(){
    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::resource('/category', 'CategoryController');
    Route::resource('/product', 'ProductController'); 
    Route::post('/product/status/{id}', 'ProductController@status')->name('product.status');
    Route::get('/product/variation/{id}', 'ProductController@variation')->name('product.variation'); 
    Route::get('/variation/edit/{id}', 'ProductController@variationEdit')->name('variation.edit');  
    Route::post('/variation/update/{id}', 'ProductController@variationUpdate');  
    Route::get('/orders', 'AdminController@Order')->name('admin.orders');
    Route::get('/orders/details/{id}', 'AdminController@OrderDetails')->name('admin.order-details');
    Route::get('/transactions', 'AdminController@Transactions')->name('admin.transctions');
    Route::get('/transaction/details/{id}', 'AdminController@transactionDetails')->name('admin.transactions-details');
    Route::get('/order/shipping/{id}', 'AdminController@Shipping')->name('admin.shipping');
    Route::get('/order/status/{id}', 'AdminController@status')->name('order.status');
    Route::post('/status/update/{id}', 'AdminController@updateStatus');
    Route::get('/users', 'AdminController@Users')->name('admin.users');
    Route::get('/admin/users/order/{id}', 'AdminController@userOrders')->name('admin.user-orders');
    Route::get('/admin/users/transaction/{id}', 'AdminController@userTransactions')->name('admin.user-transactions');
    Route::get('/designs/download/{id}', 'AdminController@getDownloads')->name('design.download');
    Route::post('/users/notification', 'AdminController@pushNotify');
    Route::get('/users/notify', 'AdminController@notify')->name('admin.notify');
    Route::get('/admin/notify/{id}', 'AdminController@updateNotify')->name('update.admin-notify');
    Route::get('admin/analytics', 'AdminController@Analytical')->name('admin.analytical');
    Route::get('/admin/profile', 'AdminController@adminProfile')->name('admin.profile');
    Route::post('/admin/profile/update', 'AdminController@updateProfile');
    Route::post('/admin/notification/clear', 'AdminController@AdminNotify_clear');

});
});


Auth::routes();
Route::get('/', 'HomeController@index')->name('index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/products/details/{id}', 'HomeController@productDetails')->name('product-details');
Route::post('/cart/{id}', 'CartController@add')->name('carts.add');
Route::resource('/carts', 'CartController');
Route::resource('/products', 'ProductController');
Route::resource('/checkout', 'CheckoutController');
Route::get('/payment/{trxref}', 'CheckoutController@verify')->name('verify.pay');
Route::post('/checkout/payments', 'CheckoutController@storeOrder');
Route::get('/address/checkout', 'CheckoutController@addNew')->name('checkout.addNew');
Route::post('/checkouts', 'CheckoutController@Add');
Route::get('/howitworks', 'HomeController@Pages')->name('Howitworks');
Route::get('/pages/{id}', 'HomeController@Pages')->name('pages');
Route::get('/user/search', 'HomeController@search')->name('search');
//Route::post('/test', 'CheckoutController@test');
Route::get('/category/{id}', 'HomeController@Categories')->name('user.category');
Route::middleware('auth')->group( function(){
Route::get('user/dashboard', 'HomeController@AccountIndex')->name('user.index')->middleware('auth');
Route::get('user/myaccount', 'HomeController@myAccount')->name('user.account')->middleware('auth');
Route::get('user/orders', 'HomeController@myOrders')->name('user.orders')->middleware('auth');
Route::get('user/transactions', 'HomeController@myTransactions')->name('user.transactions')->middleware('auth');
Route::get('/users/order/details/{id}', 'HomeController@OrderDetails')->name('user.order-details');
Route::post('/users/account/details', 'HomeController@updateDetails')->name('update.user-details');
Route::get('/user/notify', 'HomeController@notifications')->name('user.notification');
Route::get('/user/notify/delete/{id}', 'HomeController@notificationDel')->name('notify.delete');
});





//Admin Routes


