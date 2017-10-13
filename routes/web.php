
<?php
Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/', 'HomeController@index')->name('home');

Auth::routes();
Route::get('/', 'TimelineController@dashboard')->name('dashboard');
Route::get('/api/feed', 'TimelineController@feed');

Route::post('/api/search', 'SearchController@results');
Route::get('/search', 'SearchController@index');


Route::get('/id{user}', 'ProfileController@show')->name('profile.show');
Route::get('/users', 'ProfileController@index')->name('users.index');

Route::get('/api/id{user}/posts', 'ProfileController@getPosts');

Route::get('/settings/account', 'SettingsController@account')->name('settings.account');
Route::post('/settings/account', 'SettingsController@postAccount');
Route::get('/settings/profile', 'SettingsController@profile')->name('settings.profile');
Route::post('/settings/profile', 'SettingsController@postProfile');

Route::post('/post/store', 'PostController@store')->name('post.store');
Route::post('post/{post}/store', 'PostController@storeReply')->name('reply.store');

// Route::post('/api/post/{post}/reply', 'PostController@storeReply');
Route::delete('/api/post/{post}/delete', 'PostController@destroy');
Route::post('/api/post/store/{post?}', 'PostController@store');
Route::put('/api/post/{post}', 'PostController@update');

/** Following */
Route::post('/api/follow/{user}', 'FollowersController@store')->name('follow');
Route::delete('/api/follow/{user}', 'FollowersController@destroy')->name('unfollow');

/** Likes */
//Route::get('/post/{post}/like', 'LikeController@store')->name('post.like');
//Route::get('/post/{post}/unlike', 'LikeController@destroy')->name('post.unlike');
Route::post('/api/post/{post}/like', 'LikeController@store');
Route::delete('/api/post/{post}/like', 'LikeController@destroy');