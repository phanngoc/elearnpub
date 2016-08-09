<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Cart extends Model {

	protected $table = 'carts';

	protected $fillable = [
		'book_id',
		'count',
		'bill_id',
		'unit_price'
	];

	/**
	 * Relation One to One
	 * @return [type] [description]
	 */
	public function book() {
		return $this->hasOne('App\Models\Book','id','book_id');
	}
}
