<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\BookBundle;
use App\Models\Bundle;
use Carbon\Carbon;
use DB;
use Auth;

class Bundle extends Model {

	use SoftDeletes;

	protected $table = 'bundles';

	const WAITACCEPT = 0;
	const ACCEPT = 1;
	const REFUSE = 2;

	const PUBLISH = 1;
	const NOPUBLISH = 2;

	protected $fillable = [
		'title',
		'bundleurl',
		'description',
		'minimum',
		'user_id',
		'is_published',
		'published_at'
	];

	/**
	 * Relation one to many
	 * @return [type] [description]
	 */
	public function statebundle() {
		return $this->belongsTo('App\Models\Statebundle', 'suggested', 'id');
	}

	/**
	 * Relation many to one.
	 * @return [type] [description]
	 */
	public function user() {
		return $this->belongsTo('App\User', 'user_id', 'id');
	}

	/**
	 * Relation many to one.
	 * @return [type] [description]
	 */
	public function price() {
		return $this->hasOne('App\Models\Price', 'item_id', 'id')->where('type', Price::TYPE_BUNDLE);
	}

	/**
	 * Relation many to many.
	 * @return [type] [description]
	 */
	public function books() {
		return $this->belongsToMany('App\Models\Book', 'book_bundle', 'bundle_id', 'book_id')
								->withPivot('royalty', 'accepted');
	}

	/**
	 * Create new bundle from data request
	 * @param array $arr [description]
	 */
	public function addNewBundle(array $data) {
		$data['user_id'] = Auth::user()->id;
		return self::create($data);
	}

	/**
	 * Update new bundle from data request
	 * @param array $arr [description]
	 */
	public function updateBundle(array $data, $id) {
		$data['user_id'] = Auth::user()->id;
		return self::find($id)->update($data);
	}

	/**
	 * Delete bundle by id and book bundle
	 * @return [type] [description]
	 */
	public function deleteBundleAndRelation($bundleid) {
		$this->bundle->find($bundleid)->delete();
		$this->bookbundle->where('bundle_id', $bundleid)->delete();
	}

	/**
	 * Check author owe bundle.
	 * @param  [type] $authorId [description]
	 * @param  [type] $bundleId [description]
	 * @return [type]           [description]
	 */
	public function checkOweBundle($authorId, $bundleId) {
		$countBundle = $this->bundle->find($bundleId)->where('user_id', $authorId)->count();
		if ($countBundle) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Query get bestseller book in week.
	 * @param  [Illuminate\Database\Eloquent\Builder] $query
	 * @return [Illuminate\Support\Collection]
	 */
	public function scopeBestsellerBundleInWeek($query) {

		$dateNow = Carbon::now();
		$monday = $dateNow->startOfWeek()->toDateTimeString();
		$sunday = $dateNow->endOfWeek()->toDateTimeString();

		return $query
								->join('book_bundle', function ($join) {
										$join->on('book_bundle.bundle_id', '=', 'bundles.id')
												 ->where('book_bundle.accepted', '=', self::ACCEPT);
								})
								->join('books', function ($join) {
										$join->on('books.id', '=', 'book_bundle.book_id')
												 ->where('books.is_published', '=', Book::PUBLISH);
								})
								->join('carts', function ($join) use ($monday, $sunday) {
										$join->on('carts.item_id', '=', 'bundles.id')
													->where('carts.type', '=', Cart::TYPE_BUNDLE)
													->where('carts.updated_at', '>=', $monday)
													->where('carts.updated_at', '<=', $sunday);
								})

								->groupBy('bundles.id')
								->select(['bundles.*', DB::raw('IF(SUM(count), SUM(count), 0) as sellcount'),
													DB::raw('concat("[\"", GROUP_CONCAT(distinct books.diravatar SEPARATOR "\",\""), "\"]") AS avatar')])
								->orderBy('sellcount', 'desc');
	}

	/**
	 * Query get bestseller book in week.
	 * @param  [Illuminate\Database\Eloquent\Builder] $query
	 * @return [Illuminate\Support\Collection]
	 */
	public function scopeBestsellerBundle($query) {

		$dateNow = Carbon::now();
		$monday = $dateNow->startOfWeek()->toDateTimeString();
		$sunday = $dateNow->endOfWeek()->toDateTimeString();

		return $query
								->join('book_bundle', function ($join) {
										$join->on('book_bundle.bundle_id', '=', 'bundles.id')
												 ->where('book_bundle.accepted', '=', self::ACCEPT);
								})
								->join('books', function ($join) {
										$join->on('books.id', '=', 'book_bundle.book_id')
												 ->where('books.is_published', '=', Book::PUBLISH);
								})
								->join('carts', function ($join) use ($monday, $sunday) {
										$join->on('carts.item_id', '=', 'bundles.id')
													->where('carts.type', '=', Cart::TYPE_BUNDLE);
								})

								->groupBy('bundles.id')
								->select(['bundles.*', DB::raw('IF(SUM(count), SUM(count), 0) as sellcount'),
													DB::raw('concat("[\"", GROUP_CONCAT(distinct books.diravatar SEPARATOR "\",\""), "\"]") AS avatar')])
								->orderBy('sellcount', 'desc');
	}

	/**
	 * Query get views book in week.
	 * @param  [Illuminate\Database\Eloquent\Builder] $query
	 * @return [Illuminate\Support\Collection]
	 */
	public function scopePopularBundleInWeek($query) {
		$dateNow = Carbon::now();
		$monday = $dateNow->startOfWeek()->toDateTimeString();
		$sunday = $dateNow->endOfWeek()->toDateTimeString();

		return $query
								->join('book_bundle', function ($join) {
										$join->on('book_bundle.bundle_id', '=', 'bundles.id')
												 ->where('book_bundle.accepted', '=', self::ACCEPT);
								})
								->join('books', function ($join) {
										$join->on('books.id', '=', 'book_bundle.book_id')
												 ->where('books.is_published', '=', Book::PUBLISH);
								})
								->leftJoin('popularity', function ($join) use ($monday, $sunday) {
										$join->on('popularity.item_id', '=', 'bundles.id')
													->where('popularity.type', '=', Popularity::TYPE_BUNDLE)
													->where('popularity.updated_at', '>=', $monday)
													->where('popularity.updated_at', '<=', $sunday);
								})
								->groupBy(['bundles.id', 'popularity.type'])
								->select(['bundles.*', DB::raw('COUNT(*) as views'),
													DB::raw('concat("[\"", GROUP_CONCAT(distinct books.diravatar SEPARATOR "\",\""), "\"]") AS avatar')])
								->orderBy('views', 'desc');
	}

	/**
	 * Query get views bundle in week.
	 * @param  [Illuminate\Database\Eloquent\Builder] $query
	 * @return [Illuminate\Support\Collection]
	 */
	public function scopePopularBundleLifetime($query) {

		return $query
								->join('book_bundle', function ($join) {
										$join->on('book_bundle.bundle_id', '=', 'bundles.id')
												 ->where('book_bundle.accepted', '=', self::ACCEPT);
								})
								->join('books', function ($join) {
										$join->on('books.id', '=', 'book_bundle.book_id')
												 ->where('books.is_published', '=', Book::PUBLISH);
								})
								->leftJoin('popularity', function ($join) {
										$join->on('popularity.item_id', '=', 'bundles.id')
													->where('popularity.type', '=', Popularity::TYPE_BUNDLE);
								})
								->groupBy(['bundles.id', 'popularity.type'])
								->select(['bundles.*', DB::raw('COUNT(*) as views'),
													DB::raw('concat("[\"", GROUP_CONCAT(distinct books.diravatar SEPARATOR "\",\""), "\"]") AS avatar')])
								->orderBy('views', 'desc');
	}

	/**
	 * Query get bundle that is recently updated.
	 * @param  [Illuminate\Database\Eloquent\Builder] $query
	 * @return [Illuminate\Support\Collection]
	 */
	public function scopeBundleRecentlyUpdated($query) {
		return $query
								->join('book_bundle', function ($join) {
										$join->on('book_bundle.bundle_id', '=', 'bundles.id')
												 ->where('book_bundle.accepted', '=', self::ACCEPT);
								})
								->join('books', function ($join) {
										$join->on('books.id', '=', 'book_bundle.book_id')
												 ->where('books.is_published', '=', Book::PUBLISH);
								})
								->leftJoin('popularity', function ($join) {
										$join->on('popularity.item_id', '=', 'bundles.id')
													->where('popularity.type', '=', Popularity::TYPE_BUNDLE);
								})
								->groupBy(['bundles.id', 'popularity.type'])
								->select(['bundles.*', DB::raw('COUNT(*) as views'),
													DB::raw('concat("[\"", GROUP_CONCAT(distinct books.diravatar SEPARATOR "\",\""), "\"]") AS avatar')])

								->orderBy('updated_at', 'desc');
	}

	/**
	 * Query get bundle that is recently published.
	 * @param  [Illuminate\Database\Eloquent\Builder] $query
	 * @return [Illuminate\Support\Collection]
	 */
	public function scopeBundleRecentlyIsPublished($query) {
		return $query
								->join('book_bundle', function ($join) {
										$join->on('book_bundle.bundle_id', '=', 'bundles.id')
												 ->where('book_bundle.accepted', '=', self::ACCEPT);
								})
								->join('books', function ($join) {
										$join->on('books.id', '=', 'book_bundle.book_id')
												 ->where('books.is_published', '=', Book::PUBLISH);
								})
								->leftJoin('popularity', function ($join) {
										$join->on('popularity.item_id', '=', 'bundles.id')
													->where('popularity.type', '=', Popularity::TYPE_BUNDLE);
								})
								->groupBy(['bundles.id', 'popularity.type'])
								->select(['bundles.*', DB::raw('COUNT(*) as views'),
													DB::raw('concat("[\"", GROUP_CONCAT(distinct books.diravatar SEPARATOR "\",\""), "\"]") AS avatar')])

								->orderBy('published_at', 'desc');
	}

	/**
	 * Choose filter for book.
	 * @param  [type] $filter [description]
	 * @param  [type] $query  [description]
	 * @return [type]         [description]
	 */
	public function scopeChooseFilter($query, $filter) {

		switch ($filter) {
			case 'this_week_best_seller':
				$query->bestsellerBundleInWeek();
				break;
			case 'lifetime_best_seller':
				$query->bestsellerBundle();
				break;
			case 'this_week_popular_bundle':
				$query->popularBundleInWeek();
				break;
			case 'lifetime_popular_bundle':
				$query->popularBundleLifetime();
				break;
			case 'recently_updated':
				$query->bundleRecentlyUpdated();
				break;
			case 'first_published':
				$query->bundleRecentlyIsPublished();
				break;

			default:
				break;
		}

		return $query;
	}

	/**
	 * Get bundle detail.
	 * @param  [type] $bundleUrl [description]
	 * @return [type]            [description]
	 */
	public function bundleDetail($bundleUrl){
		return self::with(['price', 'books', 'books.author'])
								->where('bundleurl', $bundleUrl)
								->first();
	}
}
