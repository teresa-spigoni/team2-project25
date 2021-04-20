<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', 'UserController@home')->name('homepage');
Route::get('/home', 'HomeController@index')->name('dashboard');
Route::get('/doctors', 'UserController@toIndex')->name('toIndex');
Route::get('/doctors/{user}', 'UserController@show')->name('show');
Route::get('/create', 'UserController@create')->name('create');
// Route::get('/review', 'ReviewController@index')->name('')

Route::prefix('auth')
    ->namespace('Auth')
    ->middleware('auth')
    ->group(function () {
        Route::get('edit/{user}', 'PrivateUserController@edit')->name('edit');
        Route::put('update/{user}', 'PrivateUserController@update')->name('update');
        Route::delete('destroy/{user}', 'PrivateUserController@destroy')->name('destroy');
    });
