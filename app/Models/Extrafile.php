<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Extrafile extends Model {

	protected $table = 'extrafile';

	protected $fillable = [
		'name',
		'link',
		'extra_id',
		'is_attached'
	];
}
