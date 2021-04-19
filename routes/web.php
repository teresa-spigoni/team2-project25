<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return view('public.homepage');
})->name('homepage');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('dashboard');
Route::get('/doctors', 'UserController@index')->name('index');
Route::get('/doctors/{user}', 'UserController@show')->name('show');
Route::get('/create', 'UserController@create')->name('create');

Route::prefix('auth')
    ->namespace('Auth')
    ->middleware('auth')
    ->group(function () {
        Route::get('edit/{user}', 'PrivateUserController@edit')->name('edit');
        Route::put('update/{user}', 'PrivateUserController@update')->name('update');
        Route::delete('destroy/{user}', 'PrivateUserController@destroy')->name('destroy');
    });
