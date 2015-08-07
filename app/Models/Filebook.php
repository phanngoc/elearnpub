<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Filebook extends Model {

	protected $table = 'filebooks';

	protected $fillable = [
		'user_id',
	];
}
