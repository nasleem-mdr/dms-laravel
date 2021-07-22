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


Route::middleware('has.role')->group(function () {
    Route::view('dashboard', 'layouts.dashboard')->name('dashboard');

    Route::prefix('role-and-permission')->namespace('Permissions')->middleware('permission:assign permission')->group(function () {

        Route::get('assignable', 'AssignController@create')->name('assign.create');
        Route::post('assignable', 'AssignController@store');
        Route::get('assignable/{role}/edit', 'AssignController@edit')->name('assign.edit');
        Route::put('assignable/{role}/edit', 'AssignController@update');
        //user
        Route::get('assign/user', 'UserController@create')->name('assign.user.create');
        Route::post('assign/user', 'UserController@store');
        Route::get('assign/{user}/user', 'UserController@edit')->name('assign.user.edit');
        Route::put('assign/{user}/user', 'UserController@update');

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

    Route::prefix('navigation')->middleware('permission:create navigation')->group(function () {
        Route::get('create', 'NavigationController@create')->name('navigation.create');
        Route::post('create', 'NavigationController@store');
        Route::get('table', 'NavigationController@table')->name('navigation.table');
        Route::get('{navigation}/edit', 'NavigationController@edit')->name('navigation.edit');
        Route::put('{navigation}/edit', 'NavigationController@update');
        Route::delete('{navigation}/delete', 'NavigationController@destroy')->name('navigation.delete');
    });

    Route::prefix('agency')->middleware('permission:create agency')->group(function () {
        Route::get('create', 'AgencyController@create')->name('agency.create');
        Route::post('create', 'AgencyController@store');
        Route::get('table', 'AgencyController@index')->name('agency.table');
        Route::get('{agency}', 'AgencyController@show')->name('agency.detail');
        Route::get('{agency}/edit', 'AgencyController@edit')->name('agency.edit');
        Route::put('{agency}/edit', 'AgencyController@update');
        Route::delete('{agency}/delete', 'AgencyController@destroy')->name('agency.delete');

        Route::prefix('{agency}/position')->middleware('permission:create positions')->group(function () {
            Route::get('create', 'PositionController@create')->name('position.create');
            Route::post('create', 'PositionController@store');
            Route::get('table', 'PositionController@index')->name('position.table');
            Route::get('{position}', 'PositionController@show')->name('position.detail');
            Route::get('{position}/edit', 'PositionController@edit')->name('position.edit');
            Route::put('{position}/edit', 'PositionController@update');
            Route::delete('{position}/delete', 'PositionController@destroy')->name('position.delete');
        });
    });
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
