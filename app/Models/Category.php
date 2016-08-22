<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Category extends Model {

	use TrailFindEloquent;
	
	protected $table = 'categories';

	protected $fillable = [
		'name',
	];
}
