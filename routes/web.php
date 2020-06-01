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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login/{locale?}', 'UtilsController@loadLoginPage')->name('login');

Route::group(['namespace' => 'Auth'], function() {
    Route::get('/register/{locale?}', 'AuthController@create')->name('user.create');    
    Route::post('/register', 'AuthController@store')->name('user.register');
    Route::post('/auth_user', 'AuthController@authenticate')->name('user.auth');
    Route::get('/forgot-password/{locale?}', 'AuthController@forgotPassword')->name('forgot-password');
});

Route::group(['middleware' => 'auth', 'namespace' => 'Auth'], function() {
    Route::get('/dashboard', function() { return view('panel.dashboard'); })->name('dashboard');    
    Route::get('/logout', 'AuthController@logout')->name('user.logout');
});