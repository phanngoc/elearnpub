<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use DB;

class Extrafile extends Model {

	protected $table = 'extrafile';

	protected $fillable = [
		'name',
		'link',
		'extra_id',
		'is_attached'
	];

	/**
	 * [getFileIsUploaded description]
	 * @param  [type] $book_id [description]
	 * @return [type]          [description]
	 */
	public static function getFileIsUploaded($book_id)
	{
	  $extras = DB::table('extrafile')->where('is_attached',0)->where('extra_id',$book_id)->get();
		return $extras;
	}

	/**
	 * [deleteFile description]
	 * @param  [type] $book_id  [description]
	 * @param  [type] $filename [description]
	 * @return [type]           [description]
	 */
	public static function deleteFileInCreateExtra($book_id,$filename)
	{
		$extra = DB::table('extrafile')->where('is_attached',0)->where('extra_id',$book_id)->where('name',$filename)->delete();
	}

	public static function getIdentityByName($filename)
	{
			return DB::table('extrafile')->where('name',$filename)->first()->link;
	}

}
