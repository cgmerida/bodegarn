<?php

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

Route::get('/home', function () {
    return view('admin.dashboard.index');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::resource('users', 'UserController');
    Route::resource('roles', 'RoleController');
    Route::resource('projects', 'ProjectController');
    Route::resource('materials', 'MaterialController');
    Route::put('materials/{material}/add', 'MaterialController@add')->name('materials.add');
    Route::get('projects/materials/assign', 'ProjectController@getAssign')->name('projects.assign');
    Route::post('projects/{project}/materials/assign', 'ProjectController@assign');


    Route::view('admin', 'admin.dashboard.index')->name('admin.dash');
});
