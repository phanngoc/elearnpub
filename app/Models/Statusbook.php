<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Statusbook extends Model {

	protected $table = 'statusbook';

	protected $fillable = [
		'name',
	];
}