<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Permission extends Model {

	protected $table = 'permissions';

	protected $fillable = [
		'name',
	];
}
