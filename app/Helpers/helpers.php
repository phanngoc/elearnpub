<?php

function showImage($name) {
	if (File::exists(base_path().'/public/avatar/'.$name)) {
		return Asset('avatar/'.$name);
	} else {
		return Asset('images/default-avatar.png');
	}
}