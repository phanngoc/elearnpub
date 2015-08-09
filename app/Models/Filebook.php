<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Filebook extends Model {

	protected $table = 'filebooks';

	protected $fillable = [
		'name',
		'link',
		'content',
		'book_id',
		'is_sample',
	];
}
