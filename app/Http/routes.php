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

Route::post('/sendTwitter', 'tweetController@sendTwitter_send');

Route::get('/profile', 'tweetsController@profile_show');

Route::post('/profile', 'tweetsController@profile_follow');

Route::get('/timeline', 'tweetsController@timeline_show');

Route::get('/preference', 'adminController@preference');

Route::post('/abc', 'adminController@xyz');

Route::get('/all_users', 'followController@display_all_user');

Route::get('/who_to_follow', 'followController@display_unfollowed');

Route::get('/already_followed', 'followController@display_followed');

Route::get('/logout', 'adminController@logout');