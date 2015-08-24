<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Language extends Model {

	protected $table = 'languages';

	protected $fillable = [
    'language_name'
	];
}
