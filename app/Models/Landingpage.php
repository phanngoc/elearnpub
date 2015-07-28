<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Landingpage extends Model {

	protected $table = 'landingpage';

	protected $fillable = [
		'youtube_url',
		'vimeo_url',
		'meta_description',
		'about',
		'isshowreadcount',
		'feedback_display',
		'statusbook_id',
	];
	

	public function employee() {
		return $this->belongsTo('App\Employee');
	}

}
