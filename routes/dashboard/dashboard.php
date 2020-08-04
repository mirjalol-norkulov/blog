<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'DashboardController@dashboard');

Route::prefix('users')->group(function () {
    require __DIR__ . '/users.php';
});
