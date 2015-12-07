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

Route::get('/register', 'adminController@register_display');

Route::post('/register', 'adminController@register_process');

Route::get('/login', 'adminController@login_display');

Route::post('/login', 'adminController@login_process');

Route::get('/logout', 'adminController@logout');

Route::get('/sendTwitter', 'tweetController@sendTwitter_display');

Route::post('/sendTwitter', 'tweetController@sendTwitter_process');

Route::get('/profile', 'tweetsController@profile_display');

Route::post('/profile', 'tweetsController@profile_follow');

Route::get('/timeline', 'tweetsController@timeline_show');

Route::get('/profile_and_settings', ['middleware'=>'log' ,'uses' => 'adminController@display']);

Route::post('/profile_and_settings', ['middleware'=>'log' ,'uses' => 'adminController@processing']);

Route::get('/all_users', 'followController@display_all_user');

Route::get('/who_to_follow', 'followController@display_unfollowed');

Route::get('/already_followed', 'followController@display_followed');

