<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class BookUser extends Model {

	protected $table = 'book_author';

	protected $fillable = [
		'book_id',
		'author_id',
		'is_main',
	];

}
