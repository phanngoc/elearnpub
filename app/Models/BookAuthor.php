<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class BookAuthor extends Model {

	protected $table = 'book_author';

	protected $fillable = [
		'book_id',
		'author_id',
		'is_main',
		'is_accepted',
		'message'
	];

	/**
	 * Relation one to many
	 * @return [type] [description]
	 */
	public function carts() {
		return $this->hasMany('App\Models\Cart','bill_id','id');
	}

	/**
	 * Check main author book.
	 * @param  [type] $authorId [description]
	 * @param  [type] $bookId   [description]
	 * @return [type]           [description]
	 */
	public static function checkAuthorAndMain($authorId, $bookId) {
		$check = BookAuthor::where('book_id',$bookId)->where('author_id',$authorId)->where('is_main',1)->first();
		if (count($check) == 0) {
			return false;
		} else {
			return true;
		}
	}
}
