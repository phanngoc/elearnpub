<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Package extends Model {

	protected $table = 'package';

	protected $fillable = [
		'name',
		'minimumprice',
		'suggestedprice',
    'description',
    'url',
    'quantity',
    'book_id'
	];

}
