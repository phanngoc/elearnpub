<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Statebundle extends Model {

	protected $table = 'state_bundle';

	protected $fillable = [
		'name',
	];

	/**
	 * Relation one to many
	 * @return [type] [description]
	 */
	public function carts() {
		return $this->hasMany('App\Models\Cart','bill_id','id');
	}
}
