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

Route::get('/', function () {
    return redirect(route('login'));
});

Route::get('/home', function () {
    return redirect('/user/home');
});

Auth::routes();

//all admin Routes
Route::group(['prefix' => 'admin', 'namespace' => 'admin'], function () {

	Route::group(['middleware' => ['authentic']],function(){
        Route::get('home', 'AdminController@index');

        Route::get('users', 'UserController@index');
		Route::post('users/store', 'UserController@store');
		Route::get('users/list', 'UserController@list');
		Route::post('users/show', 'UserController@show');
		Route::post('users/update', 'UserController@update');
		Route::post('users/status', 'UserController@status');

		Route::get('product', 'ProductController@index');
		Route::post('product/store', 'ProductController@store');
		Route::get('product/list', 'ProductController@list');
		Route::post('product/show', 'ProductController@show');
		Route::post('product/update', 'ProductController@update');
		Route::get('product-images/{id}', 'ProductController@productimages');
		Route::post('product/showimage', 'ProductController@showimage');
		Route::post('product/updateimage', 'ProductController@updateimage');
		Route::get('product/productimages', 'ProductController@productimages');
		Route::post('product/storeimages', 'ProductController@storeimages');
		Route::post('product/destroyimage', 'ProductController@destroyimage');
		Route::post('product/status', 'ProductController@status');

    });
});

//user all route
Route::group(['prefix' => 'user', 'namespace' => 'user'], function () {

	Route::group(['middleware' => ['authentic']],function(){
        Route::get('/home', 'UserController@index');

		Route::get('product', 'ProductController@index');
		Route::post('product/store', 'ProductController@store');
		Route::get('product/list', 'ProductController@list');
		Route::post('product/show', 'ProductController@show');
		Route::post('product/update', 'ProductController@update');
		Route::get('product-images/{id}', 'ProductController@productimages');
		Route::post('product/showimage', 'ProductController@showimage');
		Route::post('product/updateimage', 'ProductController@updateimage');
		Route::get('product/productimages', 'ProductController@productimages');
		Route::post('product/storeimages', 'ProductController@storeimages');
		Route::post('product/destroyimage', 'ProductController@destroyimage');
		Route::post('product/status', 'ProductController@status');

    });
});
