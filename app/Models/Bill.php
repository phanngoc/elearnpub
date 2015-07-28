<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Bill extends Model {

	protected $table = 'bills';

	protected $fillable = [
		'user_id',
	];
}
