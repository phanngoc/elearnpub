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


// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', ['as' => 'login' ,'uses' => 'Auth\AuthController@postLogin']);
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register','Auth\AuthController@getRegister');
Route::post('auth/register', ['as' => 'register' ,'uses' => 'Auth\AuthController@postRegister']);




Route::get('/','HomeController@index');
Route::get('bo/{param}',['as' => 'bookhome', 'uses' => 'HomeController@book']);
Route::get('test','HomeController@test');
Route::get('write/{id}/{namefile?}',['as' => 'writebook', 'uses' => 'HomeController@write'])->where('id', '[0-9]+');
Route::post('ajax_renamefile',['as' => 'renamefile', 'uses' => 'HomeController@ajax_renamefile']);
Route::post('ajax_removefile',['as' => 'removefile', 'uses' => 'HomeController@ajax_removefile']);
Route::post('ajax_newfile/{id}',['as' => 'newfile', 'uses' => 'HomeController@ajax_newfile'])->where('id', '[0-9]+');
Route::post('ajax_issample',['as' => 'issamplefile', 'uses' => 'HomeController@ajax_issample']);
Route::post('ajax_autoSaveContentFile',['as' => 'autoSaveContent', 'uses' => 'HomeController@ajax_autoSaveContentFile']);