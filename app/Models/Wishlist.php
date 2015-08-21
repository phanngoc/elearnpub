<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Auth;

class Wishlist extends Model {

	protected $table = 'wishlist';

	protected $fillable = [
		'user_id',
	];


}
