<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class BookBundle extends Model {

	protected $table = 'book_bundle';

	protected $fillable = [
		'book_id',
		'bundle_id',
		'royalty',
		'accepted',
	];

	/**
	 * Relation one to many.
	 * @return [type] [description]
	 */
	public function book() {
		return $this->belongsTo('App\Models\Book','book_id','id');
	}

	/**
	 * Relation one to many.
	 * @return [type] [description]
	 */
	public function bundle() {
		return $this->belongsTo('App\Models\Bundle','bundle_id','id');
	}


}
