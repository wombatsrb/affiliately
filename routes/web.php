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
    
    
    
});
