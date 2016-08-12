<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Popularity extends Model {

	protected $table = 'popularity';

	protected $fillable = [
		'identity',
		'action',
		'book_id',
	];

}
