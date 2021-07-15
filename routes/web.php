<?php

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

    return view('welcome');
});

Route::view('dashboard', 'layouts.dashboard');


Route::middleware('has.role')->prefix('xyz')->group(function () {
    Route::view('dashboard', 'layouts.dashboard')->name('dashboard');

    Route::prefix('role-and-permission')->namespace('Permissions')->group(function () {

        Route::get('assignable', 'AssignController@create')->name('assign.create');
        Route::post('assignable', 'AssignController@store');
        Route::get('assignable/{role}/edit', 'AssignController@edit')->name('assign.edit');
        Route::put('assignable/{role}/edit', 'AssignController@update');

        Route::prefix('roles')->group(function () {
            Route::get('', 'RoleController@index')->name('roles.index');
            Route::post('create', 'RoleController@store')->name('roles.create');
            Route::get('{role}/edit', 'RoleController@edit')->name('roles.edit');
            Route::put('{role}/edit', 'RoleController@update');
            Route::delete('{role}/delete', 'RoleController@destroy')->name('roles.delete');
        });
        Route::prefix('permissions')->group(function () {
            Route::get('', 'PermissionController@index')->name('permissions.index');
            Route::post('create', 'PermissionController@store')->name('permissions.create');
            Route::get('{permission}/edit', 'PermissionController@edit')->name('permissions.edit');
            Route::put('{permission}/edit', 'PermissionController@update');
            Route::delete('{permission}/delete', 'PermissionController@destroy')->name('permissions.delete');
        });
    });
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
