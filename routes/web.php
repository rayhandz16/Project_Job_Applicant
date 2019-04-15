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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('applicants', 'ApplicantsController');
Route::resource('admin', 'AdminController');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/status', 'AdminController@status')->name('admin.status');

Route::get('/pdf/{id}', 'AdminController@pdf')->name('admin.pdf');

Route::get('/download/{id}', 'AdminController@download')->name('admin.download');

Route::get('/manage_user', 'AdminController@manage_user')->name('admin.manage_user');