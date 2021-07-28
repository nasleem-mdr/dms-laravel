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


Route::get('/', 'HomeController@index')->name('home');

Route::middleware('has.role')->group(function () {

    Route::view('dashboard', 'layouts.dashboard')->name('dashboard');

    Route::prefix('profile')->middleware('permission:edit profile')->group(function () {
        Route::get('/', 'ProfileController@show')->name('profile.show');
        Route::get('/edit', 'ProfileController@edit')->name('profile.edit');
        Route::put('/edit', 'ProfileController@update')->name('profile.update');
        Route::delete('{employee}/delete', 'ProfileController@destroy')->name('profile.delete');
        Route::get('/resetpassword', 'ProfileController@editPassword')->name('profile.reset_password');
        Route::put('/resetpassword', 'ProfileController@resetPassword');
    });

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

    Route::prefix('employee')->middleware('permission:create employee')->group(function () {
        Route::get('table', 'EmployeeController@index')->name('employee.table');
        Route::get('create', 'EmployeeController@create')->name('employee.create');
        Route::post('create', 'EmployeeController@store');
        Route::get('{employee}/edit', 'EmployeeController@edit')->name('employee.edit');
        Route::put('{employee}/edit', 'EmployeeController@update');
        Route::delete('{employee}/delete', 'EmployeeController@destroy')->name('employee.delete');
        Route::put('{employee}/resetpassword', 'EmployeeController@resetPassword')->name('employee.reset_password');
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

    Route::prefix('year')->middleware('permission:create year')->group(function () {
        Route::get('create', 'YearController@create')->name('year.create');
        Route::post('create', 'YearController@store');
        Route::get('{year}/edit', 'YearController@edit')->name('year.edit');
        Route::put('{year}/edit', 'YearController@update');
        Route::delete('{year}/delete', 'YearController@destroy')->name('year.delete');
    });

    Route::prefix('category')->middleware('permission:create category')->group(function () {
        Route::get('create', 'DocumentCategoryController@create')->name('category.create');
        Route::post('create', 'DocumentCategoryController@store');
        Route::get('{category}/edit', 'DocumentCategoryController@edit')->name('category.edit');
        Route::put('{category}/edit', 'DocumentCategoryController@update');
        Route::delete('{category}/delete', 'DocumentCategoryController@destroy')->name('category.delete');
    });

    Route::prefix('archive')->middleware('permission:create archive')->group(function () {
        Route::get('table', 'ArchiveController@index')->name('archive.table');
        Route::get('create', 'ArchiveController@create')->name('archive.create');
        Route::post('create', 'ArchiveController@store');
        Route::get('{archive}/edit', 'ArchiveController@edit')->name('archive.edit');
        Route::put('{archive}/edit', 'ArchiveController@update');
        Route::delete('{archive}/delete', 'ArchiveController@destroy')->name('archive.delete');
    });

    Route::prefix('document')->middleware('permission:create document')->group(function () {
        Route::get('table', 'DocumentController@index')->name('document.table');
        Route::get('create', 'DocumentController@create')->name('document.create');
        Route::post('create', 'DocumentController@store');
        Route::get('{document}/edit', 'DocumentController@edit')->name('document.edit');
        Route::put('{document}/edit', 'DocumentController@update');
        Route::delete('{document}/delete', 'DocumentController@destroy')->name('document.delete');
        Route::get('{document}/download', 'DocumentController@download')->name('document.download');
    });
});


Auth::routes();


//API get position from agency 
Route::get('/agency/{agency}/positions', 'AgencyController@getPositionFromAgency');

// jumlah arsip kepegawaian , jumlah arsip dinamis, 
// jumlah instansi/unit, jumlah posisi pada suatu instansi

// get total row of table, ex ; Agencies, Positions
Route::get('/get/total/{Entity}', 'ChartController@getTotalOf');

// get total of agency relation , ex : archives, documents, or employees
Route::get('/get/total/agency/{agency_relation}', 'ChartController@getTotal');
