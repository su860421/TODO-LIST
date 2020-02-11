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



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware'=>'auth'],function(){//不登入無法進入
  Route::get('/', function () {
      return view('todolist');
  });
});
Route::post('/new','OwnlistController@newlist');
Route::post('/finish','OwnlistController@finishlist');
Route::get('/show','OwnlistController@showlist');
Route::post('/updat','OwnlistController@updatlist');
Route::put('/update','OwnlistController@updatelist');
