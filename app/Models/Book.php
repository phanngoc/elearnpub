<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use DB;
use URL;
use File;
use App\Models\Filebook;
use Storage;
use Auth;

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
		'teaser',
		'meta_description',
		'custom_about_author',
		'youtube_url',
		'vimeo_url',
		'progress',
		'custom_author_name'
	];


	public function author() {
		return $this->belongsToMany('App\User','book_author','author_id','book_id');
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
	 * Get main author of book
	 * @param  id of book
	 * @return [type]
	 */
	public static function getMainAuthor($book_id)
	{
		$item = DB::table('book_author')->where('book_id', $book_id)->where('is_main',1)->join('users', 'users.id', '=', 'book_author.author_id')->first();
		return $item;
	}

	/**
	 * [getFileFromBook description]
	 * @param  [type] $book_id [description]
	 * @return [type]          [description]
	 */
	public static function getFileFromBook($book_id)
	{
		$files = Filebook::where('book_id',$book_id)->get();

		if (count($files) == 0)
		{
			DB::table('filebooks')->insert([
   				[
					'name' => 'sample1.txt',
					'link' => 'sample1.txt',
					'content' => '',
					'book_id' => $book_id,
					'is_sample' => 0,
				],
   				[
					'name' => 'sample2.txt',
					'link' => 'sample2.txt',
					'content' => '',
					'book_id' => $book_id,
					'is_sample' => 0,
				],
				[
					'name' => 'sample3.txt',
					'link' => 'sample3.txt',
					'content' => '',
					'book_id' => $book_id,
					'is_sample' => 0,
				]
			]);
			$content = "#Hello , This is a text sample";

			if(!File::exists(base_path().DIRECTORY_SEPARATOR.'book'.DIRECTORY_SEPARATOR.$book_id)) {
			  File::makeDirectory(base_path().DIRECTORY_SEPARATOR.'book'.DIRECTORY_SEPARATOR.$book_id);
			}

			$file1 = base_path().DIRECTORY_SEPARATOR.'book'.DIRECTORY_SEPARATOR.$book_id.DIRECTORY_SEPARATOR.'sample1.txt';
			$file2 = base_path().DIRECTORY_SEPARATOR.'book'.DIRECTORY_SEPARATOR.$book_id.DIRECTORY_SEPARATOR.'sample2.txt';
			$file3 = base_path().DIRECTORY_SEPARATOR.'book'.DIRECTORY_SEPARATOR.$book_id.DIRECTORY_SEPARATOR.'sample3.txt';

			File::put($file1, $content);
			File::put($file2, $content);
			File::put($file3, $content);

			$files = Filebook::where('book_id',$book_id)->get();
		}

		return $files;
	}

	/**
	 * get current file by url
	 * @param  [type] $name    [description]
	 * @param  [type] $default [description]
	 * @return [type]          [description]
	 */
	public static function getContentByName($name,$default)
	{
		if($name == '')
		{
			$name = $default;
		}
		return Filebook::where('name',$name)->first();
	}

	/**
	 * [getBookPublished description]
	 * @return [type] [description]
	 */
	public static function getBookPublished()
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
	public static function getBookUnPublished()
	{
		$user_id = Auth::user()->id;
		$book_publist = DB::table('books')->where('is_published',0)->join('book_author', 'book_author.book_id', '=', 'books.id')
            ->where('author_id', '=', $user_id)->get();
        return $book_publist;
	}

	/**
	 * [getCategory description]
	 * @param  [type] $book_id [description]
	 * @return [type]          [description]
	 */
	public static function getCategory($book_id)
	{
		$categories = DB::table('category')->join('book_category','book_category.category_id','=','category.id')->where('book_id',$book_id)->get();
		return $categories;
	}
}
