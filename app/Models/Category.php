<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Category extends Model {

	protected $table = 'category';

	protected $fillable = [
		'name',
	];
}
