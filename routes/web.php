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
use App\Events\SendMessage;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/t', 'NotificationController@ahihi');
Route::post('/t', 'NotificationController@index')->name('ahihi');
Route::get('/clear-noti', 'NotificationController@clear')->name('clear-number-noti');