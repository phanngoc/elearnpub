<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use DB;

class Extra extends Model {

	protected $table = 'extra';

	protected $fillable = [
		'name',
		'description',
		'package_id',
	];

  public static function getExtraByPackageId($pack_id)
  {
      return DB::table('extra')->where('package_id',$pack_id)->get();
  }

}
