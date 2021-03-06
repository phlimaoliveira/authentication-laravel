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
Route::get('/email_verification', 'UtilsController@emailVerificationSend')->name('user.emailVerification');
Route::view('/code_expired', 'auth.passwords.token_expired')->name('code_expired');

Route::group(['namespace' => 'Auth'], function() {
    Route::get('/register/{locale?}', 'RegisterController@create')->name('user.create');    
    Route::post('/register', 'RegisterController@store')->name('user.register');
    Route::post('/auth_user', 'AuthController@authenticate')->name('user.auth');
    Route::get('/forgot-password/{locale?}', 'ForgotPasswordController@forgotPassword')->name('forgot-password');
    Route::post('/forgot-password', 'ForgotPasswordController@forgot')->name('user.forgot-password');
    Route::post('/reset_password', 'ForgotPasswordController@resetPassword')->name('user.reset-password');    
    Route::get('/passwords/reset/{token}', 'ForgotPasswordController@showFormResetPassword');
});

Auth::routes(['register' => false, 'verify' => true]);

Route::group(['middleware' => 'auth'], function() {
    Route::get('/dashboard/{locale?}', 'DashboardController@index')->name('dashboard');    
    Route::get('/logout', 'Auth\AuthController@logout')->name('user.logout');
});