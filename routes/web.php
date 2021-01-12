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

Route::group(['middleware' => 'auth'], function(){
    Route::get('dashboard', 'Admin\DashboardController@dashboard')->name('dashboard');
    Route::get('users', 'Admin\UserController@getUsers')->name('users.index');
    Route::patch('users/{user}/update', 'Admin\UserController@updateUser')->name('user.update');
    Route::get('users/{user}/edit', 'Admin\UserController@editUser')->name('user.edit');
    Route::delete('users/{id}/delete', 'Admin\UserController@deleteUser')->name('user.delete');
    Route::get('users/create', 'Admin\UserController@createUser')->name('user.create');
    Route::post('users/create', 'Admin\UserController@insertUser')->name('user.insert');
});

Route::group(['middleware' => 'guest'], function(){
    Route::get('login', 'Auth\LoginController@loginForm');
    Route::post('login', 'Auth\LoginController@login');
});


Auth::routes();


