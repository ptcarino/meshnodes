<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('/forum', 'ForumsController@index');
Route::get('/forum/rations-request', 'ForumsController@rations');
Route::get('/forum/rescue-efforts', 'ForumsController@rescue');

//Route::get('chatdata', 'ChatsController@getMessages');
//Route::post('sendMessages', 'ChatsController@sendMessages');