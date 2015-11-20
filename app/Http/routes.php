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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/login', 'adminController@login_show');

Route::post('/login', 'adminController@login_login');

Route::get('/register', 'adminController@register_show');

Route::post('/register', 'adminController@register_addUser');

Route::get('/sendTwitter', 'tweetController@sendTwitter_show');