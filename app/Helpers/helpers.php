<?php

/**
 * Show full url of avatar image.
 * @param  [string] $name
 * @return [string] full link to image
 */
function imageUser($name) {
	if (File::exists(base_path() . '/public/uploads/' . $name)) {
		return Asset('uploads/'.$name);
	} else {
		return Asset('images/default-avatar.png');
	}
}

/**
 * Show full url of book image.
 * @param  [string] $name
 * @return [string] full link to image
 */
function imageBook($name) {
	if (File::exists(base_path() . '/public/uploads/' . $name)) {
		return Asset('uploads/' . $name);
	} else {
		return Asset('uploads/question-mark.png');
	}
}

/**
 * Generate random string.
 * @param  integer $length [description]
 * @return [type]          [description]
 */
function generateRandomString($length = 10) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}
