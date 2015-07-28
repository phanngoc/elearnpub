<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Price extends Model {

	protected $table = 'prices';

	protected $fillable = [
		'price',
		'book_id',
		'count',
	];
	

	public function employee() {
		return $this->belongsTo('App\Employee');
	}

}
