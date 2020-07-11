<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
Route::group(['prefix' => '/posts'], function() {
  Route::get('', 'PostController@index')->name('post.index');
  Route::get('/create', 'PostController@create')->name('post.create');
  Route::post('/store', 'PostController@store')->name('post.store');
  Route::post('/category', 'PostController@fetch')->name('post.fetch');
  Route::get('/{post_id}', 'PostController@show')->name('post.show');
  Route::get('/edit/{post_id}', 'PostController@edit')->name('post.edit');
  Route::put('/update/{post_id}', 'PostController@update')->name('post.update');
  Route::delete('/destroy/{post_id}', 'PostController@destroy')->name('post.destroy');
  Route::post('/{post_id}/favorite', 'FavoriteController@store')->name('favorite.store');
  Route::delete('/{post_id}/unfavorite', 'FavoriteController@destroy')->name('favorite.destroy');
});

Route::get('/users/{user_id}', 'UserController@show')->name('user.show');



Route::get('/home', 'HomeController@index')->name('home');
