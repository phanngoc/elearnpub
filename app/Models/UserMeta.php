<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Statusbook extends Model {

	protected $table = 'user_meta';

	protected $fillable = [
		'user_id',
		'meta_key',
		'meta_value',
	];
}
