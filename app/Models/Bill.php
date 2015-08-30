<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Bill extends Model {

	protected $table = 'bills';

	protected $fillable = [
		'user_id',
		'phone',
		'coupon_code',
		'address_receive_good',
		'date_purchased'
	];
}
