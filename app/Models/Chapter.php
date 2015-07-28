<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Chapter extends Model {

	protected $table = 'chapters';

	protected $fillable = [
		'title',
		'book_id',
		'content',
		'is_sample'
	];
	

	public function employee() {
		return $this->belongsTo('App\Employee');
	}

}
