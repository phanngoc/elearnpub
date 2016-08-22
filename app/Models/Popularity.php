<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Popularity extends Model {

	const TYPE_BOOK = 1;
	const TYPE_BUNDLE = 2;

	protected $table = 'popularity';

	protected $fillable = [
		'identity',
		'action',
		'item_id',
		'type'
	];

}
