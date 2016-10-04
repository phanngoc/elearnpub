<?php
// Route for admin.

Route::group(['prefix' => 'admin'], function() {
		Route::get('v', ['as' => 'admin.home', 'uses' => 'Admin\AdminController@homeAdmin']);
		Route::get('user/list', ['as' => 'admin.list.user', 'uses' => 'Admin\UserController@listUsers']);
		Route::get('user/edit/{id}', ['as' => 'admin.list.edit', 'uses' => 'Admin\UserController@edit']);
		Route::post('user/update/{id}', ['as' => 'admin.list.update', 'uses' => 'Admin\UserController@update']);
		Route::get('role/list', ['as' => 'admin.role.list', 'uses' => 'Admin\UserController@listRoles']);
		Route::post('uploads', ['as' => 'admin.uploads', 'uses' => 'Admin\AdminController@uploads']);
		Route::get('book/list', ['as' => 'admin.book.list', 'uses' => 'Admin\BookController@listBooks']);
		Route::get('book/{id}', ['as' => 'admin.book.detail', 'uses' => 'Admin\BookController@findBook']);
		Route::post('book/{id}', ['as' => 'admin.book.update', 'uses' => 'Admin\BookController@update']);

		Route::post('book/publish', ['as' => 'admin.book.publish', 'uses' => 'Admin\BookController@publishBook']);
		Route::get('bundle/{id}', ['as' => 'admin.book.bundle', 'uses' => 'Admin\BundleController@find']);
		Route::post('bundle/{id}', ['as' => 'admin.book.bundle.update', 'uses' => 'Admin\BundleController@update']);
		Route::get('package/{id}', ['as' => 'admin.book.package', 'uses' => 'Admin\PackageController@find']);
		Route::post('package/{id}', ['as' => 'admin.book.package.update', 'uses' => 'Admin\PackageController@update']);

		Route::get('account/identity', ['as' => 'admin.account.identity', 'uses' => 'Admin\UserController@identity']);
		Route::post('account/login', ['as' => 'admin.account.login', 'uses' => 'Admin\UserController@login']);
		Route::get('account/logout', ['as' => 'admin.account.logout', 'uses' => 'Admin\UserController@logout']);

		Route::get('bill/list', ['as' => 'admin.bill.list', 'uses' => 'Admin\BillController@listBills']);
		Route::get('bill/{id}/cart', ['as' => 'admin.bill.cart', 'uses' => 'Admin\BillController@listCartInBill']);

		Route::get('bill/chart-by-month', ['as' => 'admin.bill.chart.month', 'uses' => 'Admin\BillController@billChartMonth']);
		Route::get('bill/chart-top-seller', ['as' => 'admin.bill.chart.topsell', 'uses' => 'Admin\BillController@chartTopSell']);
});
