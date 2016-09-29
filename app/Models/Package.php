<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Package extends Model {

	protected $table = 'packages';

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
	 * Have many extras.
	 * @return [type] [description]
	 */
	public function extras() {
			return $this->hasMany('App\Models\Extra', 'package_id', 'id');
	}

	/**
	 * Relation many to one.
	 * @return [type] [description]
	 */
	public function book() {
		return $this->belongsTo('App\Models\Book', 'book_id', 'id');
	}

	/**
	 * Delete package.
	 * @param  [int] $package_id [description]
	 * @return [type]             [description]
	 */
	public function deletePackage($package_id)
	{
		$extras = Extra::where('package_id',$package_id)->get();
		foreach ($extras as $key => $value) {
			Extrafile::where('extra_id',$value->id)->where('is_attached',1)->delete();
			Extra::find($value->id)->delete();
		}
		Package::find($package_id)->delete();
	}
}
