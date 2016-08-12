<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use DB;
use URL;
use File;
use App\Models\Filebook;
use Storage;
use Auth;
use App\User;
use Carbon\Carbon;

class Book extends Model {

	use TrailFindEloquent;

	protected $table = 'books';

	protected $fillable = [
		'title',
		'subtitle',
		'description',
		'thankyoumessage',
		'bookurl',
		'language_id',
		'google_analytic',
		'teaser',
		'meta_description',
		'custom_about_author',
		'youtube_url',
		'vimeo_url',
		'progress',
		'custom_author_name',
		'avatar',
		'diravatar',
		'copyright'
	];

	/**
	 * Many to many author.
	 * @return [type] [description]
	 */
	public function author() {
		return $this->belongsToMany('App\User','book_author','author_id','book_id');
	}

	/**
	 * Many to many bundle.
	 * @return [type] [description]
	 */
	public function bundles() {
		return $this->belongsToMany('App\Models\Bundle', 'book_bundle', 'bundle_id', 'book_id');
	}

	/**
	 * Many to Many relation
	 *
	 * @return Illuminate\Database\Eloquent\Relations\belongsToMany
	 */
	public function category() {
		return $this->belongsToMany('\App\Models\Category', 'book_category');
	}

	/**
	 * One to many relation
	 * @return [type] [description]
	 */
	public function filebooks() {
		return $this->hasMany('App\Models\Filebook','book_id','id');
	}

	/**
	 * Get main author of book
	 * @param  id of book
	 * @return [type]
	 */
	public function getMainAuthor($bookId)
	{
		$item = DB::table('book_author')->where('book_id', $bookId)->where('is_main', 1)
						->join('users', 'users.id', '=', 'book_author.author_id')->first();
		return $item;
	}

	/**
	 * Get file from book.
	 * @param  [type] $book_id [description]
	 * @return [type]          [description]
	 */
	public function getFileFromBook($bookId)
	{
		$files = Filebook::where('book_id', $bookId)->get();

		if (count($files) == 0)
		{
			DB::table('filebooks')->insert([
   				[
					'name' => 'sample1.txt',
					'link' => 'sample1.txt',
					'content' => '',
					'book_id' => $bookId,
					'is_sample' => 0,
				],
   				[
					'name' => 'sample2.txt',
					'link' => 'sample2.txt',
					'content' => '',
					'book_id' => $bookId,
					'is_sample' => 0,
				],
				[
					'name' => 'sample3.txt',
					'link' => 'sample3.txt',
					'content' => '',
					'book_id' => $bookId,
					'is_sample' => 0,
				]
			]);

			$content = "#Hello , This is a text sample";

			if(!File::exists(base_path().DIRECTORY_SEPARATOR.'book'.DIRECTORY_SEPARATOR.$bookId)) {
			  File::makeDirectory(base_path().DIRECTORY_SEPARATOR.'book'.DIRECTORY_SEPARATOR.$bookId);
			}

			$file1 = base_path() . DIRECTORY_SEPARATOR . 'book' . DIRECTORY_SEPARATOR . $bookId . DIRECTORY_SEPARATOR . 'sample1.txt';
			$file2 = base_path() . DIRECTORY_SEPARATOR . 'book' . DIRECTORY_SEPARATOR . $bookId . DIRECTORY_SEPARATOR . 'sample2.txt';
			$file3 = base_path() . DIRECTORY_SEPARATOR . 'book' . DIRECTORY_SEPARATOR . $bookId . DIRECTORY_SEPARATOR . 'sample3.txt';

			File::put($file1, $content);
			File::put($file2, $content);
			File::put($file3, $content);

			$files = Filebook::where('book_id',$bookId)->get();
		}

		return $files;
	}

	/**
	 * Get current file by url
	 * @param  [type] $name    [description]
	 * @param  [type] $default [description]
	 * @return [type]          [description]
	 */
	public function getContentByName($name,$default)
	{
		if($name == '')
		{
			$name = $default;
		}
		return Filebook::where('name',$name)->first();
	}

	/**
	 * Get book is published.
	 * @return [type] [description]
	 */
	public function getBookPublished()
	{
		$user_id = Auth::user()->id;
		$book_publist = DB::table('books')->where('is_published',1)->join('book_author', 'book_author.book_id', '=', 'books.id')
            ->where('author_id', '=', $user_id)->get();
    return $book_publist;
	}

	/**
	 * [getBookUnPublished description]
	 * @return [type] [description]
	 */
	public function getBookUnPublished()
	{
		$user_id = Auth::user()->id;
		$book_publist = DB::table('books')->where('is_published',0)->join('book_author', 'book_author.book_id', '=', 'books.id')
            ->where('author_id', '=', $user_id)->get();
        return $book_publist;
	}

	/**
	 * get all category of book
	 * @param  [type] $book_id [description]
	 * @return [type]          [description]
	 */
	public function getCategory($book_id)
	{
		$categories = DB::table('category')->join('book_category','book_category.category_id','=','category.id')->where('book_id',$book_id)->get();
		return $categories;
	}

	/**
	 * find all author who write book with book_id
	 * @param  [type] $book_id [description]
	 * @return [type]          [description]
	 */
	public function findCoAuthor($book_id)
	{
		$coauthor = DB::table('book_author')->where('book_id',$book_id)->where('is_main','!=',2)->get();
		foreach ($coauthor as $key => $value) {
			$user = User::find($value->author_id);
			$coauthor[$key]->objAuthor = $user;
		}
		return $coauthor;
	}

	/**
	 * [deleteCoAuthor description]
	 * @param  [type] $book_id   [description]
	 * @param  [type] $author_id [description]
	 * @return [type]            [description]
	 */
	public static function deleteCoAuthor($book_id,$author_id)
	{
		 DB::table('book_author')->where('book_id',$book_id)->where('author_id',$author_id)->where('is_main',0)->delete();
	}

	/**
	 * [addContributorByUsername description]
	 * @param [type] $book_id  [description]
	 * @param [type] $username [description]
	 */
	public function addContributorByUsername($book_id, $username)
	{
		$user = User::where('username', $username)->first();
		if($user != null)
		{
			DB::table('book_author')->insert([
                'author_id' => $user->id,
                'book_id' => $book_id,
                'is_main' => 2,
                'royalty' => 0,
                'is_accepted' => 1,
                'message' => ''
        	]);
		}

	}

	/**
	 * [getContributorOfBook description]
	 * @param  [type] $book_id [description]
	 * @return [type]          [description]
	 */
	public static function getContributorOfBook($book_id)
	{
		return DB::table('book_author')
		->join('books','books.id','=','book_author.book_id')
		->join('users','users.id','=','book_author.author_id')
		->where('book_id',$book_id)->where('is_main',2)->get();
	}

	/**
	 * [editContributorByUsername description]
	 * @param  [type] $book_id   [description]
	 * @param  [type] $author_id [description]
	 * @param  [type] $username  [description]
	 * @return [type]            [description]
	 */
	public function editContributorByUsername($book_id,$author_id,$username)
	{
		$user = User::where('username',$username)->first();
		if($user != null)
		{
			if($user->id == $author_id)
			{
				return;
			}
			else
			{
				DB::table('book_author')->where('book_id',$book_id)
					->where('author_id',$author_id)->update([
		                'author_id' => $user->id,
	        	]);
			}
		}
	}

	/**
	 * [getPackageBelongBook description]
	 * @param  [type] $book_id [description]
	 * @return [type]          [description]
	 */
	public static function getPackageBelongBook($book_id)
	{
		$packages = Package::where('book_id','=',$book_id)->get();
		return $packages;
	}

	/**
	 * Add new book to database.
	 * @param [array] $data array data from request
	 * @return [type]  $book object book model which has just created
	 */
	public function addNewBook($data)
	{
		$book = Book::create([
            'title' => $data['title'],
            'bookurl' => $data['bookurl'],
            'language_id' => 1,
            'avatar' => 'question-mark.png',
            'diravatar' => 'question-mark.png',
        ]);

        DB::table('book_author')->insert([
            'book_id' => $book->id,
            'author_id' => Auth::user()->id,
            'is_main' => 1,
            'is_accepted' => 1,
        ]);

        Price::create([
        	'item_id' => 'bo|'.$book->id,
        	'minimumprice' => 0,
        	'suggestedprice' => 0,
        ]);

        return $book;
	}

	/**
	 * Check book belong user.
	 * @param  [type]  $book_id [description]
	 * @param  [type]  $user_id [description]
	 * @return boolean          [description]
	 */
	public function isBookBelongUser($book_id,$user_id)
	{
		$bookauthor = DB::table('book_author')->where('book_id',$book_id)->where('author_id',$user_id)->get();
		return count($bookauthor);
	}

	/**
	 * Get book user can read.
	 * @param  [type] $user_id [description]
	 * @return [type]          [description]
	 */
	public function getBookLibraryBelongUser($user_id)
	{
		$bookYouWrite = User::find($user_id)->books()->get();
		$bills = User::find($user_id)->bills()->get();

		foreach ($bills as $key => $bill) {
			$carts = $bill->carts()->get();
			foreach ($carts as $keyCart => $valCart) {
				$books = $valCart->book()->get();
				foreach ($books as $keyBook => $valBook) {
					$bookYouWrite->push($valBook);
				}
			}
		}
		return $bookYouWrite;
	}

	/**
	 * Count view of detail book.
	 * @param  [int] $bookId [description]
	 */
	public function countViewBook($bookId)
	{
		$bookYouWrite = User::find($user_id)->books()->get();
		$bills = User::find($user_id)->bills()->get();

		foreach ($bills as $key => $bill) {
			$carts = $bill->carts()->get();
			foreach ($carts as $keyCart => $valCart) {
				$books = $valCart->book()->get();
				foreach ($books as $keyBook => $valBook) {
					$bookYouWrite->push($valBook);
				}
			}
		}
		return $bookYouWrite;
	}

	/**
	 * Query get feature book.
	 * @param  [Illuminate\Database\Eloquent\Builder] $query
	 * @return [type]        [description]
	 */
	public function scopeFeatureBook($query) {
		return $query
								->leftJoin('book_author', 'book_author.book_id', '=', 'books.id')
								->leftJoin('users', function ($join) {
										$join->on('users.id', '=', 'book_author.author_id')
												 ->where('book_author.is_main', '=', 1);
								})
								->where('books.is_published', 1)->orderBy('books.updated_at')
								->select(['books.*', 'users.firstname', 'users.lastname']);
	}

	/**
	 * Query get bestseller book.
	 * @param  [Illuminate\Database\Eloquent\Builder] $query
	 * @return [type]        [description]
	 */
	public function scopeBestsellerBook($query) {
		return $query
								->leftJoin('book_author', 'book_author.book_id', '=', 'books.id')
								->leftJoin('users', function ($join) {
										$join->on('users.id', '=', 'book_author.author_id')
													->where('book_author.is_main', '=', 1);
								})
								->leftJoin('carts', 'carts.book_id', '=', 'books.id')
					 			->where('books.is_published', 1)
								->groupBy('books.id')
								->select(['books.*', 'users.firstname', 'users.lastname',
												DB::raw('IF(SUM(count), SUM(count), 0) as sellcount')])
								->orderBy('sellcount', 'desc');
	}

	/**
	 * Query get bestseller book in week.
	 * @param  [Illuminate\Database\Eloquent\Builder] $query
	 * @return [Illuminate\Support\Collection]
	 */
	public function scopeBestsellerBookInWeek($query) {
		$dateNow = Carbon::now();
		$monday = $dateNow->startOfWeek();
		$sunday = $dateNow->endOfWeek();

		return $query
								->leftJoin('book_author', 'book_author.book_id', '=', 'books.id')
								->leftJoin('users', function ($join) {
										$join->on('users.id', '=', 'book_author.author_id')
													->where('book_author.is_main', '=', 1);
								})
								->leftJoin('carts', function ($join) use ($monday, $sunday) {
										$join->on('carts.book_id', '=', 'books.id')
													->where('carts.updated_at', '>=', $monday)
													->where('carts.updated_at', '<=', $sunday);
								})
								->where('books.is_published', 1)
								->groupBy('books.id')
								->select(['books.*', 'users.firstname', 'users.lastname',
												DB::raw('IF(SUM(count), SUM(count), 0) as sellcount')])
								->orderBy('sellcount', 'desc');
	}

	/**
	 * Query get views book in week.
	 * @param  [Illuminate\Database\Eloquent\Builder] $query
	 * @return [Illuminate\Support\Collection]
	 */
	public function scopePopularBookInWeek($query) {
		$dateNow = Carbon::now();
		$monday = $dateNow->startOfWeek();
		$sunday = $dateNow->endOfWeek();
		return $query
								->leftJoin('popularity', function ($join) use ($monday, $sunday) {
										$join->on('popularity.book_id', '=', 'books.id')
													->where('popularity.updated_at', '>=', $monday)
													->where('popularity.updated_at', '<=', $sunday);
								})
								->leftJoin('book_author', 'book_author.book_id', '=', 'books.id')
								->leftJoin('users', function ($join) {
										$join->on('users.id', '=', 'book_author.author_id')
													->where('book_author.is_main', '=', 1);
								})
								->where('books.is_published', 1)
								->groupBy('books.id')
								->select(['books.*', 'users.firstname', 'users.lastname',
												DB::raw('COUNT(*) as views')])
								->orderBy('views', 'desc');
	}

	/**
	 * Query get views book in week.
	 * @param  [Illuminate\Database\Eloquent\Builder] $query
	 * @return [Illuminate\Support\Collection]
	 */
	public function scopePopularBookLifetime($query) {
		return $query
								->leftJoin('popularity', function ($join) {
										$join->on('popularity.book_id', '=', 'books.id');
								})
								->leftJoin('book_author', 'book_author.book_id', '=', 'books.id')
								->leftJoin('users', function ($join) {
										$join->on('users.id', '=', 'book_author.author_id')
													->where('book_author.is_main', '=', 1);
								})
								->where('books.is_published', 1)
								->groupBy('books.id')
								->select(['books.*', 'users.firstname', 'users.lastname',
												DB::raw('COUNT(*) as views')])
								->orderBy('views', 'desc');
	}

	/**
	 * Query get book that is recently updated.
	 * @param  [Illuminate\Database\Eloquent\Builder] $query
	 * @return [Illuminate\Support\Collection]
	 */
	public function scopeBookRecentlyUpdated($query) {
		return $query
								->where('books.is_published', 1)
								->groupBy('books.id')
								->leftJoin('book_author', 'book_author.book_id', '=', 'books.id')
								->leftJoin('users', function ($join) {
										$join->on('users.id', '=', 'book_author.author_id')
													->where('book_author.is_main', '=', 1);
								})
								->select(['books.*', 'users.firstname', 'users.lastname',
												DB::raw('COUNT(*) as views')])
								->orderBy('updated_at', 'desc');
	}

	/**
	 * Query get book that is recently published.
	 * @param  [Illuminate\Database\Eloquent\Builder] $query
	 * @return [Illuminate\Support\Collection]
	 */
	public function scopeBookRecentlyIsPublished($query) {
		return $query
								->where('books.is_published', 1)
								->groupBy('books.id')
								->leftJoin('book_author', 'book_author.book_id', '=', 'books.id')
								->leftJoin('users', function ($join) {
										$join->on('users.id', '=', 'book_author.author_id')
													->where('book_author.is_main', '=', 1);
								})
								->select(['books.*', 'users.firstname', 'users.lastname',
												DB::raw('COUNT(*) as views')])
								->orderBy('updated_at', 'desc');
	}

	/**
	 * Query get book that is recently published.
	 * @param  [Illuminate\Database\Eloquent\Builder] $query
	 * @return [Illuminate\Support\Collection]
	 */
	public function scopeBookWithLanguageAndCategory($query, $languageId, $categoryId) {
		$query->where('books.is_published', 1);

		if ($languageId != "all") {
			$query->leftJoin('languages', function ($join) use ($languageId) {
					$join->on('languages.id', '=', 'books.language_id')
							 ->where('languages.id', '=', $languageId);
			});
		}

		if ($categoryId != "all") {
			$query->leftJoin('book_category', function ($join) use ($categoryId) {
					$join->on('book_category.book_id', '=', 'books.id')
								->where('book_category.category_id', '=', $categoryId);
			});
		}
		return $query;
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
				$query->bestsellerBookInWeek();
				break;
			case 'lifetime_best_seller':
				$query->bestsellerBook();
				break;
			case 'this_week_popular_book':
				$query->popularBookInWeek();
				break;
			case 'lifetime_popular_book':
				$query->popularBookLifetime();
				break;
			case 'recently_updated':
				$query->bookRecentlyUpdated();
				break;
			case 'first_published':
				$query->bookRecentlyIsPublished();
				break;

			default:
				break;
		}

		return $query;
	}
}
