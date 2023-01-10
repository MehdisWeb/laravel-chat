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

Auth::routes();

Route::get('/', 'DashboardController@index')->name('dashboard');

Route::get('chat/{userid}', 'ChatsController@index')->name('users.chat');
Route::get('chatuser', 'ChatsController@index')->name('chat');



Route::get('messages', 'ChatsController@fetchMessages');
Route::post('messages', 'ChatsController@sendMessage');


Route::get('users', 'UserController@index')->name('users.index');
Route::get('usercreate', 'UserController@create')->name('users.create');
Route::get('useredit/{userid}', 'UserController@edit')->name('users.edit');
Route::get('profile', 'UserController@profile')->name('users.profile');



Route::post('userdelete/{userid}', 'UserController@destroy')->name('users.destroy');
Route::get('userstrack', 'UserController@track')->name('users.track');
Route::get('livetracking/{id}', 'UserController@LiveTrackingUsers')->name('user.livetracking');

Route::post('userupdate/{userid}', 'UserController@update')->name('users.update');
Route::post('userstore', 'UserController@store')->name('users.store');
Route::post('updateprofile', 'UserController@updateprofile')->name('users.updateprofile');














