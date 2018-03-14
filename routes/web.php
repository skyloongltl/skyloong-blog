<?php
Route::get('/', 'PagesController@root')->name('root');

//Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

//Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

//Password Reset Routes...
Route::get('password/reset', 'AuthForgotPasswordController@showLinkRequestionForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');


Route::resource('articles', 'ArticlesController', ['only' => ['index', 'show', 'create', 'store', 'update', 'edit', 'destroy']]);
Route::resource('categories', 'CategoriesController', ['only' => ['show']]);

Route::post('upload_image', 'ArticlesController@uploadImage')->name('articles.upload_image');
Route::resource('replies', 'RepliesController', ['only' => ['store', 'destroy']]);
Route::resource('tags', 'TagsController', ['only' => ['show']]);