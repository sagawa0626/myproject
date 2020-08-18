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


Auth::routes();
Route::get('/posts/show', 'PostController@show')->middleware('auth');
Route::get('/posts/index', 'PostController@index')->name('posts.index')->middleware('auth');
Route::resource('/posts', 'PostController')->except(['index'])->middleware('auth');

Route::post('/posts/{comment_id}/comments', 'CommentsController@store');
Route::get('/comments/{comment_id}', 'CommentsController@destory');

Route::get('/', 'FamilyController@index')->middleware('auth');
Route::get('/families/create', 'FamilyController@create')->name('families.create');
Route::post('/families/store', 'FamilyController@store')->name('families.store');





Route::get('/users/edit', 'UserController@edit');
Route::get('/users/{user_id}', 'UserController@show');
Route::post('/users/update', 'UserController@update');


Route::prefix('posts')->name('posts.')->group(function () {
  Route::put('/{post}/like', 'PostController@like')->name('like')->middleware('auth');
  Route::delete('/{post}/like', 'PostController@unlike')->name('unlike')->middleware('auth');
});


