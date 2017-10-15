
<?php
Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/', 'HomeController@index')->name('home');

Auth::routes();
Route::get('/', 'TimelineController@dashboard')->name('dashboard');
Route::get('/api/feed', 'TimelineController@feed');

Route::post('/api/search', 'SearchController@results');
Route::get('/search', 'SearchController@index');


Route::get('/id{user}', 'ProfileController@show')->name('profile.show');

Route::get('/id{user}/followers', 'FollowersController@followers')->name('user.followers');
Route::get('/id{user}/following', 'FollowersController@following')->name('user.following');

Route::get('/users', 'ProfileController@index')->name('users.index');

Route::get('/api/id{user}/posts', 'ProfileController@getPosts');

Route::get('/settings/account', 'SettingsController@account')->name('settings.account');
Route::post('/settings/account', 'SettingsController@postAccount');
Route::get('/settings/profile', 'SettingsController@profile')->name('settings.profile');
Route::post('/settings/profile', 'SettingsController@postProfile');

/** Post */
Route::post('/api/post/store/{post?}', 'PostController@store');
Route::put('/api/post/{post}', 'PostController@update');
Route::delete('/api/post/{post}/', 'PostController@destroy');

Route::get('/api/post/{post}/', 'PostController@destroy');

/** Following */
Route::post('/api/follow/{user}', 'FollowersController@store')->name('follow');
Route::delete('/api/follow/{user}', 'FollowersController@destroy')->name('unfollow');

/** Likes */
Route::post('/api/post/{post}/like', 'LikeController@store');
Route::delete('/api/post/{post}/like', 'LikeController@destroy');