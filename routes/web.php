<?php

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

Route::get('/', 'HomeController@home')->name('homepage');
Route::get('/dashboard/login', 'Dashboard\Auth\LoginController@loginView')->name('dashboard.login-view');
Route::post('/dashboard/login', 'Dashboard\Auth\LoginController@login')->name('dashboard.login');
Route::post('/dashboard/logout', 'Dashboard\Auth\LoginController@logout')->name('dashboard.logout');
