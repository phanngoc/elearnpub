<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use DB;

class Extrafile extends Model {

	protected $table = 'extrafiles';

	protected $fillable = [
		'name',
		'link',
		'extra_id',
		'is_attached'
	];

	/**
	 * Get file is uploaded.
	 * @param  [int] $book_id [description]
	 * @return [type]          [description]
	 */
	public function getFileIsUploaded($book_id)
	{
	  $extras = DB::table('extrafile')->where('is_attached', 0)->where('extra_id', $book_id)->get();
		return $extras;
	}

	/**
	 * Delete file in create extra.
	 * @param  [int] $book_id  [description]
	 * @param  [string] $filename [description]
	 * @return [type]           [description]
	 */
	public function deleteFileInCreateExtra($book_id, $filename)
	{
		$extra = DB::table('extrafile')->where('is_attached', 0)->where('extra_id', $book_id)->where('name', $filename)->delete();
	}

	/**
	 * Get extra file by name.
	 * @param  [type] $filename [description]
	 * @return [type]           [description]
	 */
	public function getIdentityByName($filename)
	{
			return DB::table('extrafile')->where('name', $filename)->first()->link;
	}

	/**
	 * [attachFileIsUploadToExtra description]
	 * @param  [type] $extra_id [description]
	 * @param  [type] $book_id  [description]
	 * @return [type]           [description]
	 */
	public function attachFileIsUploadToExtra($extra_id, $book_id)
	{
			$extrafile = $this->getFileIsUploaded($book_id);
			foreach ($extrafile as $key => $value) {
				$this->find($value->id)->update(['extra_id'=>$extra_id, 'is_attached'=>1]);
			}
	}

	/**
	 * Get file is uploaded to extra.
	 * @param  [int] $extra_id [description]
	 * @return [Illuminate\Database\Eloquent\Collection]
	 */
	public function getFileIsUploadedToExtra($extra_id)
	{
		$extras = DB::table('extrafile')->where('is_attached', 1)->where('extra_id', $extra_id)->get();
		return $extras;
	}

	/**
	 * Delete file in edit extra.
	 * @param  [int] $book_id  [description]
	 * @param  [string] $filename [description]
	 * @return [type]           [description]
	 */
	public function deleteFileInEditExtra($extra_id, $filename)
	{
		$extra = DB::table('extrafile')->where('is_attached', 1)->where('extra_id', $extra_id)->where('name', $filename)->delete();
	}

	/**
	 * Get identity by name and extra.
	 * @param  [string] $filename [description]
	 * @param  [int] $extra_id [description]
	 * @return [Illuminate\Database\Eloquent\Collection]
	 */
	public function getIdentityByNameAndExtra($filename,$extra_id)
	{
			return DB::table('extrafile')->where('name',$filename)->where('extra_id',$extra_id)->first()->link;
	}
}
