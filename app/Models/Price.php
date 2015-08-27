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
		$item_id = 'bo|'.$id;
		return $this->where('item_id',$item_id)->first();
	}
}
