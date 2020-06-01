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

Route::get('/login/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'pt-br'])) {
        abort(400);
    }

    App::setLocale($locale);
    return view('auth.login');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::group(['namespace' => 'Auth'], function() {
    Route::get('/register/{locale?}', 'AuthController@create')->name('user.create');
    Route::post('/register', 'AuthController@store')->name('user.register');
});

Route::get('/forgot-password/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'pt-br'])) {
        abort(400);
    }

    App::setLocale($locale);
    return view('auth.forgot_password');
});

Route::get('/forgot-password', function () {
    return view('auth.forgot_password');
});

Route::get('/dashboard', function() {
    return view('panel.dashboard');
});