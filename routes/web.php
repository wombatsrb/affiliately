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
    
    
});