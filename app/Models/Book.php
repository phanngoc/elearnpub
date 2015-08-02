<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use DB;

class Book extends Model {

	protected $table = 'books';

	protected $fillable = [
		'title',
		'subtitle',
		'description',
		'thankyoumessage',
		'bookurl',
		'language_id',
		'google_analytic',
	];
	

	public function author() {
		return $this->belongsToMany('App\User','book_author','author_id','book_id');
	}
	/**
	 * Get main author of book
	 * @param  id of book
	 * @return [type]
	 */
	public static function getMainAuthor($book_id)
	{
		$item = DB::table('book_author')->where('book_id', $book_id)->where('is_main',1)->join('users', 'users.id', '=', 'book_author.author_id')->first(); 
		return $item;
	}
}
