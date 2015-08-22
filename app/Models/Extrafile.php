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

	/**
	 * [getIdentityByName description]
	 * @param  [type] $filename [description]
	 * @return [type]           [description]
	 */
	public static function getIdentityByName($filename)
	{
			return DB::table('extrafile')->where('name',$filename)->first()->link;
	}

	/**
	 * [attachFileIsUploadToExtra description]
	 * @param  [type] $extra_id [description]
	 * @param  [type] $book_id  [description]
	 * @return [type]           [description]
	 */
	public static function attachFileIsUploadToExtra($extra_id,$book_id)
	{
			$extrafile = Extrafile::getFileIsUploaded($book_id);
			foreach ($extrafile as $key => $value) {
				Extrafile::find($value->id)->update(['extra_id'=>$extra_id,'is_attached'=>1]);
			}
	}

	/**
	 * [getFileIsUploadedToExtra description]
	 * @param  [type] $extra_id [description]
	 * @return [type]           [description]
	 */
	public static function getFileIsUploadedToExtra($extra_id)
	{
		$extras = DB::table('extrafile')->where('is_attached',1)->where('extra_id',$extra_id)->get();
		return $extras;
	}

	/**
	 * [deleteFileInEditExtra description]
	 * @param  [type] $book_id  [description]
	 * @param  [type] $filename [description]
	 * @return [type]           [description]
	 */
	public static function deleteFileInEditExtra($extra_id,$filename)
	{
		$extra = DB::table('extrafile')->where('is_attached',1)->where('extra_id',$extra_id)->where('name',$filename)->delete();
	}

	/**
	 * [getIdentityByNameAndExtra description]
	 * @param  [type] $filename [description]
	 * @param  [type] $extra_id [description]
	 * @return [type]           [description]
	 */
	public static function getIdentityByNameAndExtra($filename,$extra_id)
	{
			return DB::table('extrafile')->where('name',$filename)->where('extra_id',$extra_id)->first()->link;
	}
}
