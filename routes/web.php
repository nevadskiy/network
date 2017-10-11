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

Route::get('/id{user}', 'ProfileController@show')->name('profile.show');

Route::get('/api/id{user}/posts', 'ProfileController@getPosts');

Route::get('/settings/account', 'SettingsController@account')->name('settings.account');
Route::post('/settings/account', 'SettingsController@postAccount');
Route::get('/settings/profile', 'SettingsController@profile')->name('settings.profile');
Route::post('/settings/profile', 'SettingsController@postProfile');

Route::post('/post/store', 'PostController@store')->name('post.store');
Route::post('post/{post}/store', 'PostController@storeReply')->name('reply.store');

Route::post('/api/post/{post}/reply', 'PostController@storeReply');
Route::delete('/api/post/{post}/delete', 'PostController@destroy');
Route::post('/api/post/store', 'PostController@store');

/** Following */
Route::get('/follow/{user}', 'FollowersController@store')->name('follow');
Route::get('/follow/{user}/unfollow', 'FollowersController@destroy')->name('unfollow');

/** Likes */
//Route::get('/post/{post}/like', 'LikeController@store')->name('post.like');
//Route::get('/post/{post}/unlike', 'LikeController@destroy')->name('post.unlike');
Route::post('/api/post/{post}/like', 'LikeController@store');
Route::delete('/api/post/{post}/like', 'LikeController@destroy');

Route::get('/dashboard', 'TimelineController@dashboard')->name('dashboard');