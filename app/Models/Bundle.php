<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Models\BookBundle;

class Bundle extends Model {

	protected $table = 'bundles';

	protected $fillable = [
		'title',
		'bundleurl',
		'description',
		'minimum',
		'user_id',
	];

	/**
	 * Relation one to many
	 * @return [type] [description]
	 */
	public function statebundle() {
		return $this->belongsTo('App\Models\Statebundle','suggested','id');
	}

	/**
	 * Relation one to many
	 * @return [type] [description]
	 */
	public function user() {
		return $this->belongsTo('App\User','user_id','id');
	}

	/**
	 * Create new bundle from data request
	 * @param array $arr [description]
	 */
	public static function addNewBundle(array $arr) {
		Bundle::create([
			'title' => $arr['title'],
			'description' => $arr['description'],
			'bundleurl' => $arr['bundleurl'],
			'minimum' => $arr['minimum'],
			'user_id' => Auth::user()->id
		]);
	} 

	/**
	 * Update new bundle from data request
	 * @param array $arr [description]
	 */
	public static function updateBundle(array $arr, $id) {
		Bundle::find($id)->update([
			'title' => $arr['title'],
			'description' => $arr['description'],
			'bundleurl' => $arr['bundleurl'],
			'minimum' => $arr['minimum'],
			'user_id' => Auth::user()->id
		]);
	} 

	/**
	 * Delete bundle by id and book bundle
	 * @return [type] [description]
	 */
	public static function deleteBundleAndRelation($bundleid) {
		Bundle::find($bundleid)->delete();
		BookBundle::where('bundle_id', $bundleid)->delete();
	}

	/**
	 * Check author owe bundle.
	 * @param  [type] $authorId [description]
	 * @param  [type] $bundleId [description]
	 * @return [type]           [description]
	 */
	public static function checkOweBundle($authorId, $bundleId) {
		$countBundle = Bundle::find($bundleId)->where('user_id', $authorId)->count();
		if ($countBundle) {
			return true;
		} else {
			return false;
		}
	} 
}
