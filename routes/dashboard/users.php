<?php

use Illuminate\Support\Facades\Route;

// Users list
// ---------------------------------------------------------------------------------------------------------------------
Route::get('/', 'UsersController@index')->name('dashboard.users.index');
// ---------------------------------------------------------------------------------------------------------------------

// Create a new user
// ---------------------------------------------------------------------------------------------------------------------
Route::get('/create', 'UsersController@createView')
    ->middleware('role:admin')
    ->name('dashboard.users.create-view');

Route::post('/create', 'UsersController@create')
    ->middleware('role:admin')
    ->name('dashboard.users.create');
// ---------------------------------------------------------------------------------------------------------------------

// Edit user
// ---------------------------------------------------------------------------------------------------------------------
Route::get('/{id}/edit', 'UsersController@editView')
    ->middleware('role:admin')
    ->name('dashboard.users.edit-view');
Route::post('/{id}/edit', 'UsersController@edit')
    ->middleware('role:admin')
    ->name('dashboard.users.edit');
// ---------------------------------------------------------------------------------------------------------------------

// Delete user
// ---------------------------------------------------------------------------------------------------------------------
Route::post('/{id}', 'UsersController@delete')
    ->name('dashboard.users.delete')
    ->middleware('role:admin');
// ---------------------------------------------------------------------------------------------------------------------
