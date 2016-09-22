<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserReadBook extends Model {

	const CAN_READ = 1;
	const CANT_READ = 0;

	protected $table = 'user_read_book';

	protected $fillable = [
		'user_id',
		'book_id',
		'is_can_read'
	];

}
