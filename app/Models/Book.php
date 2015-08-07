<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use DB;
use URL;
use File;
use App\Models\Filebook;
use Storage;

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

	public static function getFileFromBook($book_id)
	{
		$files = Filebook::where('book_id',$book_id)->get();

		if (count($files) == 0)
		{
			// Filebook::create([
			// 	'name' => 'sample1.txt',
			// 	'link' => $book_id.'/sample1.txt',
			// 	'content' => '',
			// 	'book_id' => $book_id,
			// 	'is_sample' => 0,
			// 	]);
			// Filebook::create([
			// 	'name' => 'sample2.txt',
			// 	'link' => $book_id.'/sample2.txt',
			// 	'content' => '',
			// 	'book_id' => $book_id,
			// 	'is_sample' => 0,
			// 	]);
			// Filebook::create([
			// 	'name' => 'sample3.txt',
			// 	'link' => $book_id.'/sample3.txt',
			// 	'content' => '',
			// 	'book_id' => $book_id,
			// 	'is_sample' => 0,
			// 	]);
			DB::table('filebooks')->insert([
   				[
					'name' => 'sample1.txt',
					'link' => $book_id.'/sample1.txt',
					'content' => '',
					'book_id' => $book_id,
					'is_sample' => 0,
				],
   				[
				'name' => 'sample2.txt',
				'link' => $book_id.'/sample2.txt',
				'content' => '',
				'book_id' => $book_id,
				'is_sample' => 0,
				],
				[
				'name' => 'sample3.txt',
				'link' => $book_id.'/sample3.txt',
				'content' => '',
				'book_id' => $book_id,
				'is_sample' => 0,
				]
			]);
			$content = "#Hello , This is a text sample";
			
			if(!File::exists('/var/www/html/elearnpub/book/'.$book_id)) {
			  File::makeDirectory('/var/www/html/elearnpub/book/'.$book_id);
			}
			
			$file1 = '/var/www/html/elearnpub/book/'.$book_id.'/sample1.txt';
			$file2 = '/var/www/html/elearnpub/book/'.$book_id.'/sample2.txt';
			$file3 = '/var/www/html/elearnpub/book/'.$book_id.'/sample3.txt';
			
			File::put($file1, $content);
			File::put($file2, $content);
			File::put($file3, $content);
		}
		else
		{
			$files = Filebook::where('book_id',$book_id)->get();
		}
		return $files;
	}
	public static function getContentByName($name)
	{
		if($name == '')
		{
			$name = 'sample1.txt';
		}
		return Filebook::where('name',$name)->first();
	}
}
