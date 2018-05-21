<?php

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

Route::get('/admin', 'AdminController@loginCheck')->name('adminLoginCheck');
Route::get('/admin/login', 'AdminController@adminLogin')->name('adminLogin');
Route::post('/admin/login/check', 'AdminController@adminCheck')->name('adminCheck');
Route::get('/admin/logout', 'AdminController@adminLogout')->name('adminLogout');


Route::group([ 'middleware' => 'user'], function() {
    
    
});

Route::group([ 'middleware' => 'worker'], function() {
    Route::get('/admin/dashboard', 'AdminController@adminDashboard')->name('adminDashboard');
        
    
});

Route::group([ 'middleware' => 'admin'], function() {
    Route::get('/admin/user/add', 'UsersController@addUserView')->name('addUserView');
    Route::post('/admin/user/add', 'UsersController@addUser')->name('addUser');
    Route::get('/admin/user/modify', 'UsersController@modifyUsersView')->name('modifyUsersView');
    Route::get('/admin/user/modify/{id}', 'UsersController@editUserView')->name('editUserView');
    Route::post('/admin/user/modify/{id}', 'UsersController@editUser')->name('editUser');
    Route::get('/admin/user/delete/{id}', 'UsersController@deleteUser')->name('deleteUser');
    Route::post('/admin/user/credit/{id}', 'CreditsController@addUserFunds')->name('addUserFunds');
    
    Route::get('/admin/menu', 'MenusController@viewMenu')->name('viewMenu');
    Route::post('/admin/menu/add', 'MenusController@addMenu')->name('addMenu');
    Route::get('/admin/menu/delete/{id}', 'MenusController@deleteMenu')->name('deleteMenu');
    Route::get('/admin/menu/edit/{id}', 'MenusController@singleMenuView')->name('singleMenuView');
    Route::post('/admin/menu/edit/{id}', 'MenusController@editMenu')->name('editMenu');
    
    
    Route::get('/admin/service/add', 'ServicesController@addServiceView')->name('addServiceView');
    Route::post('/admin/service/add', 'ServicesController@addService')->name('addService');
    Route::get('/admin/service/modify', 'ServicesController@modifyServicesView')->name('modifyServiceView');
    Route::get('/admin/service/modify/{id}', 'ServicesController@editServiceView')->name('editServiceView');
    Route::post('/admin/service/modify/{id}', 'ServicesController@editService')->name('editService');
    Route::get('/admin/service/delete/{id}', 'ServicesController@deleteService')->name('deleteService');

    Route::get('/admin/orders', 'OrdersController@ordersView')->name('ordersView');
    Route::get('/admin/order/{id}', 'OrdersController@orderView')->name('orderView');
    Route::get('/admin/order/create', 'OrdersController@orderCreateView')->name('orderCreateView');
    Route::post('/admin/order/create', 'OrdersController@orderCreate')->name('orderCreate');

    Route::get('/admin/order/service/{id}', 'OrdersController@orderServiceView')->name('orderServiceView');
    Route::post('/admin/order/service/charge', 'CreditsController@chargeServiceOrder')->name('chargeServiceOrder');
    Route::post('/admin/order/service/status/{id}', 'OrdersController@orderServiceStatusUpdate')->name('orderServiceStatusUpdate');
    Route::post('/admin/order/service/worker/{id}', 'OrdersController@orderServiceWorkerUpdate')->name('orderServiceWorkerUpdate');

    Route::post('/order/service/message/{id}', 'OrdersController@orderServiceSendMessage')->name('orderServiceSendMessage');
    Route::post('/admin/order/service/charge/history/{idOrderService}', 'CreditsController@getServiceChargeHistory')->name('getServiceChargeHistory');




});
