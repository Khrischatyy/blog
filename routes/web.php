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

Route::group(['namespace' => 'Blog', 'prefix' => 'blog'], function () {
    Route::resource('posts', 'PostController')->names('blog.posts');
});


$groupData = [
    'namespace' => 'Blog\Admin',
    'prefix' => 'admin/blog'
];


Route::group($groupData, function () {
    Route::resource('categories', 'CategoryController')
        ->only(['index','edit','update','create','store'])
        ->names('blog.admin.categories');
    Route::resource('posts','PostController')
        ->except(['show'])
        ->names('blog.admin.posts');
});
