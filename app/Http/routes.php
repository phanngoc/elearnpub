<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/','HomeController@index');
Route::get('bo/{param}','HomeController@book');
Route::get('test','HomeController@test');
Route::get('write/{id}/{namefile?}',['as' => 'writebook', 'uses' => 'HomeController@write']);

