<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Models\Book;
use Validator;
use Zipper;
use App\Http\Controllers\Controller;
use Auth;
use File;

class ReadBookController extends Controller
{
    /**
     * Show page read book
     * @return [type] [description]
     */
    public function readbook($id) {
        $book = Book::find($id);
        $filebooks = $book->filebooks()->get();
        $contentCombile = '';

        foreach ($filebooks as $key => $value) {
			$contentCombile .= $value->content;
        }
        
        return view('frontend.readbook',compact('book','contentCombile'));
    }

}
