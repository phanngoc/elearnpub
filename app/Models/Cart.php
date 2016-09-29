<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use App\Models\Book;
use App\Models\Bundle;
use DB;

class Cart extends Model {

	protected $table = 'carts';

	const TYPE_BOOK = 1;
	const TYPE_BUNDLE = 2;
	const TYPE_PACKAGE = 3;

	protected $fillable = [
		'item_id',
		'type',
		'count',
		'bill_id',
		'unit_price'
	];

	/**
	 * Many to one book.
	 * @return [type] [description]
	 */
	public function book() {
		return $this->belongsTo('App\Models\Book', 'item_id');
	}

	/**
	 * Find item in cart,
	 * @param $id
	 * @param $type
	 * @return mixed
	 */
	public function findItem($id, $type) {
		$query = $this;
		if ($type == self::TYPE_BOOK) {
			  $query = Book::join('prices', function($query) use ($id) {
									$query->on('prices.item_id', '=', 'books.id')
												->where('books.id', '=', $id)
												->where('prices.type', '=', self::TYPE_BOOK);
								})->select(['books.id', 'books.title', 'books.teaser', 'prices.minimumprice',
														'prices.suggestedprice', DB::raw('1 as type'),
														DB::raw('CONCAT("[\"", books.diravatar, "\"]") as avatar')]);

		} else if($type == self::TYPE_BUNDLE) {
				$query = Bundle::join('prices', function($query){
										$query->on('prices.item_id', '=', 'bundles.id')
													->where('prices.type', '=', self::TYPE_BUNDLE);
								 })
								 ->join('book_bundle', function($query){
 										$query->on('book_bundle.bundle_id', '=', 'bundles.id')
													->where('accepted', '=', 1);
 								 })
								 ->join('books', function($query){
 										$query->on('books.id', '=', 'book_bundle.book_id');
 								 })
							 	->groupBy('bundles.id')
							 	->select(['bundles.id', 'bundles.title', 'bundles.description as teaser', 'prices.minimumprice',
												 'prices.suggestedprice', DB::raw('2 as type'), DB::raw('CONCAT("[\"", "books.diravatar", "\"]") as avatar')]);

		}
		return $query->first();
	}

}
