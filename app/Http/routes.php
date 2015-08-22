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
Route::post('cart',['as' => 'cart','uses' => 'HomeController@cart']);
Route::get('cart',['as' => 'getCart','uses' => 'HomeController@getCart']);
Route::get('ajax_getCart',['as' => 'ajax_getCart','uses' => 'HomeController@ajax_getCart']);
Route::get('addwishlist/{id}',['as'=>'addwishlist','uses'=>'WishlistController@add_wishlist']);
Route::get('wishlist',['as'=>'wishlist','uses'=>'WishlistController@index']);
Route::get('deletewishlist/{id}',['as'=>'deletewishlist','uses'=>'WishlistController@delete_wishlist']);
Route::get('book',['as'=>'book','uses'=>'BookController@index']);

Route::get('settingbook/{id}',['as'=>'settingbook','uses'=>'SettingbookController@index']);
Route::post('settingbook/{id}',['as'=>'postsettingbook','uses'=>'SettingbookController@index']);

Route::get('settingbook/{id}/publish_book',['as'=>'publish_book','uses'=>'SettingbookController@publish_book']);
Route::post('settingbook/{id}/publish_book',['as'=>'post_publish_book','uses'=>'SettingbookController@post_publish_book']);

Route::get('settingbook/{id}/publish_sample_book',['as'=>'publish_sample_book','uses'=>'SettingbookController@publish_sample_book']);
Route::post('settingbook/{id}/publish_sample_book',['as'=>'post_publish_sample_book','uses'=>'SettingbookController@post_publish_sample_book']);

Route::get('settingbook/{id}/upload_new_title',['as'=>'upload_new_title','uses'=>'SettingbookController@upload_new_title']);
Route::post('settingbook/{id}/upload_new_title',['as'=>'post_upload_new_title','uses'=>'SettingbookController@post_upload_new_title']);

Route::get('settingbook/{id}/pricing',['as'=>'pricing','uses'=>'SettingbookController@pricing']);
Route::post('settingbook/{id}/pricing',['as'=>'post_pricing','uses'=>'SettingbookController@post_pricing']);

Route::get('settingbook/{id}/package',['as'=>'package','uses'=>'SettingbookController@package']);
Route::post('settingbook/{id}/package',['as'=>'post_package','uses'=>'SettingbookController@post_package']);
Route::get('settingbook/{id}/edit_package/{package_id}',['as'=>'edit_package','uses'=>'SettingbookController@editPackage']);
Route::post('settingbook/{id}/update_package/{package_id}',['as'=>'update_package','uses'=>'SettingbookController@updatePackage']);
Route::post('settingbook/{id}/package/{package_id}/delete_extra/{extra_id}',['as'=>'delete_extra','uses'=>'SettingbookController@deleteExtraInPackage']);

Route::get('settingbook/{id}/extras',['as'=>'extras','uses'=>'SettingbookController@extras']);
Route::post('settingbook/{id}/add_extra',['as'=>'add_extra','uses'=>'SettingbookController@addExtras']);
Route::post('settingbook/{id}/upload_file_extra',['as'=>'upload_file_extra','uses'=>'SettingbookController@uploadFileExtra']);
Route::get('settingbook/{id}/get_file_upload',['as'=>'get_file_upload','uses'=>'SettingbookController@ajax_getFileExtra']);
Route::get('settingbook/{id}/delete_file_extra',['as'=>'delete_file_extra','uses'=>'SettingbookController@deleteFileExtra']);

Route::get('settingbook/{id}/edit_extra/{extra_id}',['as'=>'edit_extra','uses'=>'SettingbookController@editExtra']);
Route::post('settingbook/{id}/update_extra/{extra_id}',['as'=>'update_extra','uses'=>'SettingbookController@updateExtra']);
