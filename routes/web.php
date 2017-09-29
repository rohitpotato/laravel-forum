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

Route::get('/threads', 'ThreadsController@index');
	
Route::get('/threads/{thread}', 'ThreadsController@show')->name('thread.show');
Route::get('/threads/channel/{channel}', 'ThreadsController@index')->name('channel');

Route::group(['middleware' => 'auth'], function() {

	Route::get('/thread/create', 'ThreadsController@create');

	Route::post('/threads', 'ThreadsController@store');

	Route::post('threads/{thread}/reply', 'RepliesController@store')->name('reply.store');

	Route::delete('/reply/{reply}', 'RepliesController@delete')->name('reply.delete');

	Route::get('/reply/edit/{reply}', 'RepliesController@edit')->name('reply.edit');

	Route::patch('/reply/{reply}', 'RepliesController@update')->name('reply.update');

	Route::post('/replies/{reply}/favorites', 'FavoritesController@store');

	Route::post('/replies/{reply}/unfavorites', 'FavoritesController@delete');

	Route::post('/reply/{reply}/bestreply', 'RepliesController@bestReply')->name('reply.best');

	Route::get('user/{user}', 'ProfilesController@show')->name('user.profile');

	Route::delete('/threads/{thread}', 'ThreadsController@destroy')->name('thread.delete');

	Route::get('/thread/edit/{thread}', 'ThreadsController@edit')->name('thread.edit');

	Route::patch('/threads/{thread}', 'ThreadsController@update')->name('thread.update');

	Route::post('/thread/subscribe/{thread}', 'ThreadsController@subscribe')->name('thread.subscribe');

	Route::post('/thread/unsubscribe/{thread}', 'ThreadsController@unsubscribe')->name('thread.unsubscribe');
});