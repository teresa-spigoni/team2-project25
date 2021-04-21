<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', 'UserController@home')->name('homepage');
Route::get('/home', 'HomeController@index')->name('dashboard');
Route::get('/doctors', 'UserController@toIndex')->name('toIndex');
Route::get('/doctors/{user}/{spec}', 'UserController@show')->name('show');
Route::get('/create', 'UserController@create')->name('create');
Route::get('newmessage/{user}', 'UserController@newMessage')->name('newMessage');
Route::post('/doctors/{user}', 'UserController@saveMessage')->name('saveMessage');
Route::post('/review', 'ReviewController@create')->name('review');

Route::prefix('auth')
    ->namespace('Auth')
    ->middleware('auth')
    ->group(function () {
        Route::get('edit/{user}', 'PrivateUserController@edit')->name('edit');
        Route::put('update/{user}', 'PrivateUserController@update')->name('update');
        Route::delete('destroy/{user}', 'PrivateUserController@destroy')->name('destroy');
        Route::get('messages/{user}', 'PrivateUserController@showMessages')->name('messages');
        Route::get('sponsorships/{user}', 'SponsorshipController@buySponsorship')->name('buySponsorship');
        Route::post('service/{user}', 'PrivateUserController@newService')->name('newService');
    });
