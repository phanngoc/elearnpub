<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use App\Models\Cart;

class Price extends Model {

	protected $table = 'prices';

	const TYPE_BOOK = 1;
	const TYPE_BUNDLE = 2;

	protected $fillable = [
		'item_id',
		'minimumprice',
		'suggestedprice',
	];

	public function getPriceByBookId($id)
	{
		return $this->where('item_id', $id)->where('type', Cart::TYPE_BOOK)->first();
	}
}
