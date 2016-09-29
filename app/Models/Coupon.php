<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use App\Models\Book;
use App\Models\Bundle;
use DB;

class Coupon extends Model {

	protected $table = 'coupons';

	protected $fillable = [
		'coupon_code',
		'coupon_note',
    'book_id',
		'number',
		'unit',
		'limitcount',
    'is_actived',
    'start_date',
    'end_date'
	];

}
