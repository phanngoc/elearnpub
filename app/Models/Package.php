<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Package extends Model {

	protected $table = 'package';

	protected $fillable = [
		'name',
		'minimumprice',
		'suggestedprice',
	    'description',
	    'url',
	    'quantity',
	    'book_id'
	];

	/**
	 * Delete package.
	 * @param  [type] $package_id [description]
	 * @return [type]             [description]
	 */
	public static function deletePackage($package_id)
	{
		$extras = Extra::where('package_id',$package_id)->get();
		foreach ($extras as $key => $value) {
			Extrafile::where('extra_id',$value->id)->where('is_attached',1)->delete();
			Extra::find($value->id)->delete();
		}
		Package::find($package_id)->delete();
	}
}
