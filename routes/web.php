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
// ゲストログイン
Route::get('guest', 'Auth\LoginController@authenticate')->name('login.guest');

Route::get('/', 'PostController@index')->name('post.index');
Route::group(['prefix' => '/posts'], function() {
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

Route::group(['prefix' => 'users'], function() {
  Route::get('/{user_id}', 'UserController@show')->name('user.show');
  Route::get('/{user_id}/edit', 'UserController@edit')->name('user.edit');
  Route::put('/{user_id}/update', 'UserController@update')->name('user.update');
});

Route::group(['prefix' => '/contact'], function() {
  // 入力ページ
  Route::get('/{user_id}', 'ContactController@create')->name('contact.create');
  // 確認ページ
  Route::post('/confirm', 'ContactController@confirm')->name('contact.confirm');
  // 送信完了ページ
  Route::post('/thanks', 'ContactController@send')->name('contact.send');
});


Route::get('/home', 'HomeController@index')->name('home');
