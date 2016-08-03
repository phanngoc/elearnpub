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

class LibraryController extends Controller
{
    /**
     * Show page your library
     * @return [type] [description]
     */
    public function yourLibrary() {
        $bookLibrarys = Book::getBookLibraryBelongUser(Auth::user()->id);
        return view('frontend.yourlibrary',compact('bookLibrarys'));
    }

}
