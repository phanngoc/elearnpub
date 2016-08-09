<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Price extends Model {

	protected $table = 'prices';

	protected $fillable = [
		'item_id',
		'minimumprice',
		'suggestedprice',
	];

	public function getPriceByBookId($id)
	{
		$itemId = 'bo|'.$id;
		return $this->where('item_id', $itemId)->first();
	}
}
