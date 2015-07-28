<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Invitation extends Model {

	protected $table = 'invitation';

	protected $fillable = [
		'identity',
		'message',
		'user_send',
	];

}
