<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('auth')
    ->namespace('Auth')
    ->middleware('auth')
    ->group(function () {
        Route::resource('dashboard', PrivateUserController::class);
    });
