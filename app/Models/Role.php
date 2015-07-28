<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Role extends Model {

	protected $table = 'roles';

	protected $fillable = [
		'name',
	];

}
