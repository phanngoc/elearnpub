<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use DB;

class Extra extends Model {

	protected $table = 'extras';

	protected $fillable = [
		'name',
		'description',
		'package_id',
	];

}
