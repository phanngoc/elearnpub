<?php
namespace App\Models;

trait TrailFindEloquent
{
  	/**
  	 * Find or return null.
  	 * @param  [int] $id Id of book.
  	 * @return [Object]
  	 */
  	public function findOrNull($id) {
  		if ($id == "all") {
  			return null;
  		} else {
  			return self::find($id);
  		}
  	}
}
