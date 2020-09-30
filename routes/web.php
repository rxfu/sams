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

Route::get('/', function () {
    return redirect()->route('home');
});

// Auth::routes();

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');

Route::middleware('auth')->group(function () {
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/contact', 'HomeController@contact')->name('contact');
    Route::get('/maintenance', 'HomeController@maintenance')->name('maintenance');

    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/{user}/roles', 'UserController@showRoleForm')->name('role');
        Route::post('/{user}/roles', 'UserController@assignRole');
        Route::get('/{user}/groups', 'UserController@showGroupForm')->name('group');
        Route::post('/{user}/groups', 'UserController@assignGroup');
    });

    Route::prefix('roles')->name('roles.')->group(function () {
        Route::get('/{role}/permissions', 'RoleController@showPermissionForm')->name('permission');
        Route::post('/{role}/permissions', 'RoleController@assignPermission');
    });

    Route::prefix('passwords')->name('passwords.')->group(function () {
        Route::get('/', 'PasswordController@create')->name('change');
        Route::post('/', 'PasswordController@store')->name('store');
        Route::get('/{password}/reset', 'PasswordController@edit')->name('reset');
        Route::put('/{password}', 'PasswordController@update')->name('update');
    });

    Route::prefix('deliveries')->name('deliveries.')->group(function () {
        Route::get('/import', 'DeliveryController@showImportForm')->name('import');
        Route::post('/import', 'DeliveryController@import');
        Route::get('/export', 'DeliveryController@export')->name('export');
        Route::get('/search', 'DeliveryController@search')->name('search');
        Route::get('/export-ems', 'DeliveryController@exportEms')->name('export-ems');
        Route::get('/export-notice', 'DeliveryController@exportNotice')->name('export-notice');
    });

    Route::prefix('archives')->name('archives.')->group(function () {
        Route::get('/import', 'ArchiveController@showImportForm')->name('import');
        Route::post('/import', 'ArchiveController@import');
        Route::get('/export', 'ArchiveController@export')->name('export');
        Route::get('/search', 'ArchiveController@search')->name('search');
    });

    Route::prefix('entries')->name('entries.')->group(function () {
        Route::get('/{entry}/groups', 'EntryController@showGroupForm')->name('group');
        Route::post('/{entry}/groups', 'EntryController@assignGroup');
    });

    Route::prefix('genders')->name('genders.')->group(function () {
        Route::get('/sync', 'GenderController@sync')->name('sync');
    });

    Route::prefix('idtypes')->name('idtypes.')->group(function () {
        Route::get('/sync', 'IdtypeController@sync')->name('sync');
    });

    Route::prefix('nations')->name('nations.')->group(function () {
        Route::get('/sync', 'NationController@sync')->name('sync');
    });

    Route::prefix('departments')->name('departments.')->group(function () {
        Route::get('/sync', 'DepartmentController@sync')->name('sync');
    });

    Route::prefix('majors')->name('majors.')->group(function () {
        Route::get('/sync', 'MajorController@sync')->name('sync');
    });

    Route::prefix('students')->name('students.')->group(function () {
        Route::get('/sync', 'StudentController@sync')->name('sync');
    });

    Route::resource('logs', 'LogController')->only(['index', 'show']);
    Route::resource('settings', 'SettingController');
    Route::resource('menus', 'MenuController');
    Route::resource('menuitems', 'MenuitemController');
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
    Route::resource('permissions', 'PermissionController');
    Route::resource('groups', 'GroupController');
    Route::resource('entries', 'EntryController');
    Route::resource('archives', 'ArchiveController');
    Route::resource('deliveries', 'DeliveryController');
    Route::resource('students', 'StudentController');
    Route::resource('genders', 'GenderController');
    Route::resource('nations', 'NationController');
    Route::resource('idtypes', 'IdtypeController');
    Route::resource('departments', 'DepartmentController');
    Route::resource('majors', 'MajorController');
    // route_here
});
