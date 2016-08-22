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
Route::get('auth/login', ['as' => 'getlogin','uses'=>'Auth\AuthController@getLogin']);
Route::post('auth/login', ['as' => 'login' ,'uses' => 'Auth\AuthController@postLogin']);
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register',['as' => 'getregister' ,'uses' => 'Auth\AuthController@getRegister']);
Route::post('auth/register', ['as' => 'register' ,'uses' => 'Auth\AuthController@postRegister']);

/*-----------------------Start middleware auth----------------------------------*/
Route::group(['middleware' => 'auth'], function () {

	/*---------------------write file------------------------*/
  	Route::get('write/{id}/{namefile?}',['as' => 'writebook', 'uses' => 'BookController@write'])->where('id', '[0-9]+');
  	Route::post('ajax_renamefile',['as' => 'renamefile', 'uses' => 'BookController@ajax_renamefile']);
		Route::post('ajax_removefile',['as' => 'removefile', 'uses' => 'BookController@ajax_removefile']);
		Route::post('ajax_newfile/{id}',['as' => 'newfile', 'uses' => 'BookController@ajax_newfile'])->where('id', '[0-9]+');
		Route::post('ajax_issample',['as' => 'issamplefile', 'uses' => 'BookController@ajax_issample']);
		Route::post('ajax_autoSaveContentFile',['as' => 'autoSaveContent', 'uses' => 'BookController@ajax_autoSaveContentFile']);
	/*------------------------end write file-------------------------------*/

	// Process cart.
	Route::post('cart', ['as' => 'addItemToCart','uses' => 'Front\CartController@addItemToCart']);
	Route::get('cart', ['as' => 'getCart','uses' => 'Front\CartController@getCart']);
	Route::get('ajax_getCart', ['as' => 'ajax_getCart','uses' => 'Front\CartController@ajax_getCart']);
	Route::post('updateCart', ['as' => 'updateCart','uses' => 'Front\CartController@updateCart']);

	// Process checkout page
	Route::get('checkout', ['as'=>'checkout', 'uses' => 'Front\CartController@showCheckout']);
	Route::post('checkout', ['as'=>'postcheckout', 'uses' => 'Front\CartController@postShowCheckout']);

	// Process thank you page
	Route::get('checkoutcomplete',['as'=>'checkoutcomplete','uses' => 'Front\CartController@checkoutComplete']);

	Route::get('addwishlist/{id}',['as'=>'addwishlist','uses'=>'WishlistController@add_wishlist']);
	Route::get('wishlist',['as'=>'wishlist','uses'=>'WishlistController@index']);
	Route::get('deletewishlist/{id}',['as'=>'deletewishlist','uses'=>'WishlistController@delete_wishlist']);
	Route::get('book',['as'=>'book','uses'=>'BookController@index']);

	Route::get('settingbook/{id}',['as'=>'settingbook','uses'=>'SettingbookController@index']);
	Route::post('settingbook/{id}',['as'=>'postsettingbook','uses'=>'SettingbookController@saveSettingbook']);

	Route::get('settingbook/{id}/publish_book',['as'=>'publish_book','uses'=>'SettingbookController@publishBook']);
	Route::post('settingbook/{id}/publish_book',['as'=>'post_publish_book','uses'=>'SettingbookController@postPublishBook']);

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
	Route::get('settingbook/{id}/list_package',['as'=>'list_package','uses'=>'SettingbookController@listPackage']);
	Route::get('settingbook/{id}/delete_package/{package_id}',['as'=>'delete_package','uses'=>'SettingbookController@deletePackage']);

	// create extra
	Route::get('settingbook/{id}/extras',['as'=>'extras','uses'=>'ExtraController@extras']);
	Route::post('settingbook/{id}/add_extra',['as'=>'add_extra','uses'=>'ExtraController@addExtras']);
	Route::post('settingbook/{id}/upload_file_extra',['as'=>'upload_file_extra','uses'=>'ExtraController@uploadFileExtra']);
	Route::get('settingbook/{id}/get_file_upload',['as'=>'get_file_upload','uses'=>'ExtraController@ajax_getFileExtra']);
	Route::get('settingbook/{id}/delete_file_extra',['as'=>'delete_file_extra','uses'=>'ExtraController@deleteFileExtra']);

	// edit extra
	Route::get('settingbook/{id}/edit_extra/{extra_id}',['as'=>'edit_extra','uses'=>'ExtraController@editExtra']);
	Route::post('settingbook/{id}/update_extra/{extra_id}',['as'=>'update_extra','uses'=>'ExtraController@updateExtra']);
	Route::post('settingbook/{id}/edit_upload_file_extra/{extra_id}',['as'=>'edit_upload_file_extra','uses'=>'ExtraController@editUploadFileExtra']);
	Route::get('settingbook/{id}/edit_get_file_upload/{extra_id}',['as'=>'edit_get_file_upload','uses'=>'ExtraController@editGetFileExtra']);
	Route::get('settingbook/{id}/edit_delete_file_extra/{extra_id}',['as'=>'edit_delete_file_extra','uses'=>'ExtraController@editDeleteFileExtra']);
	Route::get('settingbook/{id}/package/{package_id}/delete_extra/{extra_id}',['as'=>'delete_extra','uses'=>'ExtraController@deleteExtraInPackage']);

	// landing page
	Route::get('settingbook/{id}/landing_page',['as'=>'landing_page','uses'=>'LandingpageController@index']);
	Route::post('settingbook/{id}/landing_page',['as'=>'update_landing_page','uses'=>'LandingpageController@updateLandingPage']);

	// Percent complete
	Route::get('settingbook/{id}/percent_complete',['as'=>'percent_complete','uses'=>'LandingpageController@percentComplete']);
	Route::post('settingbook/{id}/percent_complete',['as'=>'update_percent_complete','uses'=>'LandingpageController@updatePercentComplete']);

	// Setting more
	Route::get('settingbook/{id}/category',['as'=>'category','uses'=>'SettingmoreController@category']);
	Route::post('settingbook/{id}/update_category',['as'=>'update_category','uses'=>'SettingmoreController@updateCategory']);

	// Language
	Route::get('settingbook/{id}/language',['as'=>'language','uses'=>'SettingmoreController@language']);
	Route::post('settingbook/{id}/update_language',['as'=>'update_language','uses'=>'SettingmoreController@updateLanguage']);

	// Custom author name
	Route::get('settingbook/{id}/custom_author_name',['as'=>'custom_author_name','uses'=>'AuthorController@customAuthorName']);
	Route::post('settingbook/{id}/update_custom_author_name',['as'=>'update_custom_author_name','uses'=>'AuthorController@updateCustomAuthorName']);

	// add co-author
	Route::get('settingbook/{id}/add_coauthor',['as'=>'add_coauthor','uses'=>'AuthorController@addCoAuthor']);
	Route::post('settingbook/{id}/post_add_coauthor',['as'=>'post_add_coauthor','uses'=>'AuthorController@postAddCoAuthor']);
	Route::get('settingbook/{id}/edit_coauthor',['as'=>'edit_coauthor','uses'=>'AuthorController@editCoAuthor']);
	Route::get('settingbook/{id}/delete_coauthor/{author_id}',['as'=>'delete_coauthor','uses'=>'AuthorController@deleteCoAuthor']);

	// add contributor
	Route::get('settingbook/{id}/add_contributor',['as'=>'add_contributor','uses'=>'AuthorController@addContributor']);
	Route::post('settingbook/{id}/post_add_contributor',['as'=>'post_add_contributor','uses'=>'AuthorController@postAddContributor']);
	Route::get('settingbook/{id}/list_contributor',['as'=>'list_contributor','uses'=>'AuthorController@listContributor']);

	Route::get('settingbook/{id}/show_edit_contributor/{author_id}',['as'=>'show_edit_contributor','uses'=>'AuthorController@showEditContributor']);
	Route::post('settingbook/{id}/post_show_edit_contributor/{author_id}',['as'=>'post_show_edit_contributor','uses'=>'AuthorController@postShowEditContributor']);

	Route::get('settingbook/{id}/delete_contributor/{author_id}',['as'=>'delete_contributor','uses'=>'AuthorController@deleteContributor']);

	// add and edit coupon
	Route::get('settingbook/{id}/add_coupon',['as'=>'add_coupon','uses'=>'AuthorController@addCoupon']);
	Route::post('settingbook/{id}/post_add_coupon',['as'=>'post_add_coupon','uses'=>'AuthorController@postAddCoupon']);

	// create new book
	Route::get('new_book',['as'=>'new_book','uses' => 'BookController@newBook']);
	Route::post('new_book',['as'=>'post_new_book','uses' => 'BookController@postNewBook']);

	// Route relevant bundle

	Route::get('bundles',['as'=>'bundles','uses' => 'Front\BundleController@bundles']);

	Route::get('new_bundle',['as'=>'new_bundle','uses' => 'Front\BundleController@new_bundle']);

	Route::post('post_new_bundle',['as'=>'post_new_bundle','uses' => 'Front\BundleController@postNewBundle']);

	Route::get('edit_bundle/{id}',['as'=>'edit_bundle','uses' => 'Front\BundleController@editBundle']);

	Route::get('delete_bundle/{id}',['as'=>'delete_bundle','uses' => 'Front\BundleController@deleteBundle']);

	Route::post('edit_bundle/{id}',['as'=>'post_edit_bundle','uses' => 'Front\BundleController@postUpdateBundle']);

	Route::post('edit_bundle/{id}/newbook',['as'=>'add_book_to_bundle','uses' => 'Front\BundleController@addNewBookToBundle']);

	Route::get('edit_bundle/{id}/deletebook/{book_bundle_id}',['as'=>'delete_book_from_bundle','uses' => 'Front\BundleController@deleteBookFromBundle']);

	Route::get('publish_bundle/{id}',['as' => 'publish_bundle','uses' => 'Front\BundleController@publishBundle']);

	Route::get('profile',['as'=>'profile','uses' => 'Front\ProfileController@index']);

	Route::post('profile',['as'=>'postprofile','uses' => 'Front\ProfileController@postProfile']);

	Route::get('invitation',['as'=>'invitation','uses' => 'Front\ProfileController@invitation']);

	Route::get('responseInvitation/{id}/{response}',['as'=>'responseInvitation','uses' => 'Front\ProfileController@responseInvitation']);

	// View to your library
	Route::get('library', ['as'=>'library','uses' => 'Front\LibraryController@yourLibrary']);

	// View read book on web
	Route::get('read/{id}', ['as'=>'readbook','uses' => 'Front\ReadBookController@readbook']);

	// Logout user.
	Route::get('logout', ['as'=>'logout','uses' => 'Front\ProfileController@logout']);
});

/*-----------------------End middleware auth----------------------------------*/

Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

/*-------------------------Route frontend detail book---------------------------*/

Route::get('bo/{param}', ['as' => 'bookhome', 'uses' => 'BookController@book']);
Route::get('downloadSample/{id}',['as'=>'downloadSample','uses'=>'Front\DetailBookController@downloadSample']);
/*-------------------------------------------------------------------------------*/
Route::get('test','HomeController@test');

// Create page list book belong category
Route::get('cate/{cate_id}/lang/{language_id}',['as'=>'catelang','uses'=>'HomeController@searchCateAndLang']);

// Create page search
Route::post('search',['as'=> 'search','uses'=>'HomeController@showPageSearch']);

// Watch profile of user.
Route::get('u/{profile}', ['as' => 'userprofile','uses'=>'Front\ProfileController@profileAuthor']);

// Bestselling book page.
Route::get('fi/{filter}/cate/{cate_id}/lang/{language_id}', ['as' => 'bestselling', 'uses'=>'HomeController@bestSellingBook']);

// Bestselling bundle page.
Route::get('bundles/fi/{filter}', ['as' => 'bestselling_bundle', 'uses'=>'HomeController@bestSellingBundle']);

Route::get('bundle/{bundleurl}', ['as' => 'bundle_detail', 'uses'=>'Front\BundleController@bundleDetail']);
