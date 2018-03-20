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


//Admin
Route::prefix('admin')->namespace('Admin')->group(function () {
    Route::get('/', 'HomeController@index')->name('admin.home.index');

    //User
    Route::resource('users', 'UsersController',
        [
            'names' => [
                'destroy' => 'admin.users.destroy'
                ],
            'only' => ['destroy']
        ]);
    Route::post('users/batch_destroy', 'UsersController@batchDestroy')->name('admin.users.batch-destroy');
    Route::post('users/update', 'UsersController@update')->name('admin.users.update');
    Route::post('users/search', 'UsersController@search')->name('admin.users.search');

    //Roles
    Route::resource('roles', 'RolesController',
        [
            'names' => [
                'store' => 'admin.roles.store',
                'destroy' => 'admin.roles.destroy'
            ],
            'only' => ['store', 'destroy']
        ]
    );

    Route::get('roles', 'RolesController@index')->name('admin.roles.index');
    Route::post('roles/update', 'RolesController@update')->name('admin.roles.update');
    Route::post('roles/search', 'RolesController@search')->name('admin.roles.search');

    //Permissions
    Route::resource('permissions', 'PermissionsController',
        [
            'names' => [
                'index' => 'admin.permissions.index',
                'store' => 'admin.permissions.store',
                'destroy' => 'admin.permissions.destroy'
            ],
            'only' => ['index', 'store', 'destroy']
        ]
    );
    Route::post('permissions/update', 'PermissionsController@update')->name('admin.permissions.update');
    Route::post('permissions/search', 'PermissionsController@search')->name('admin.permissions.search');
});