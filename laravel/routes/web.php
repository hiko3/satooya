<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'PostController@index')->name('post.index');
Route::get('/create', 'PostController@create')->name('post.create');
Route::post('/store', 'PostController@store')->name('post.store');
Route::post('/fetch/category', 'PostController@fetch')->name('post.fetch');
Route::get('/post/{post_id}', 'PostController@show')->name('post.show');
Route::get('/post/edit/{post_id}', 'PostController@edit')->name('post.edit');
Route::put('/post/update/{post_id}', 'PostController@update')->name('post.update');
Route::delete('/post/destroy/{post_id}', 'PostController@destroy')->name('post.destroy');

Route::get('/users/{user_id}', 'UserController@show')->name('user.show');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
