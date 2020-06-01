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
})->name('login');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::group(['namespace' => 'Auth'], function() {
    Route::get('/register/{locale?}', 'AuthController@create')->name('user.create');
    Route::post('/register', 'AuthController@store')->name('user.register');
    Route::post('/auth_user', 'AuthController@authenticate')->name('user.auth');
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

Route::group(['middleware' => 'auth', 'namespace' => 'Auth'], function() {
    Route::get('/dashboard', function() { return view('panel.dashboard'); })->name('dashboard');    
    Route::get('/logout', 'AuthController@logout')->name('user.logout');
});