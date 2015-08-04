<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Resource extends Model {

	protected $table = 'resources';

	protected $fillable = [
		'name',
		'link',
		'book_id',
		'function',
		'type',
	];
	public function getSampleByBook($id)
	{
		return $this->where('book_id',$id)->where('function','sample')->first();
	}
}
