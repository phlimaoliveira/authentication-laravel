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

Route::get('/login/{locale?}', 'UtilsController@loadLoginPage')->name('login');

Route::group(['namespace' => 'Auth'], function() {
    Route::get('/register/{locale?}', 'AuthController@create')->name('user.create');    
    Route::post('/register', 'AuthController@store')->name('user.register');
    Route::post('/auth_user', 'AuthController@authenticate')->name('user.auth');
    Route::get('/forgot-password/{locale?}', 'AuthController@forgotPassword')->name('forgot-password');
});

Auth::routes(['register' => false, 'verify' => true]);

Route::group(['middleware' => 'auth'], function() {
    Route::get('/dashboard/{locale?}', 'DashboardController@index')->name('dashboard');    
    Route::get('/logout', 'Auth\AuthController@logout')->name('user.logout');
});