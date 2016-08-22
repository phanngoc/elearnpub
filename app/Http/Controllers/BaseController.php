<?php
namespace App\Http\Controllers;

class BaseController extends Controller
{

    const static POPULARITY_TYPE_BOOK = 1;
    const static POPULARITY_TYPE_BUNDLE = 2;

    /**
     * __construct description
     * @param Book     $book     [description]
     * @param Package  $package  [description]
     * @param Extra    $extra    [description]
     */
    public function __construct()
    {

    }
}
