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
		'date_purchased',
		'transaction_complete'
	];

	/**
	 * Relation one to many
	 * @return [type] [description]
	 */
	public function carts() {
		return $this->hasMany('App\Models\Cart', 'bill_id', 'id');
	}

	/**
	 * Relation many to one.
	 * @return [type] [description]
	 */
	public function user() {
		return $this->belongsTo('App\User', 'user_id', 'id');
	}
}
