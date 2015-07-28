<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

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
	

	public function employee() {
		return $this->belongsTo('App\Employee');
	}

}
