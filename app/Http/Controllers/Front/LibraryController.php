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
     * Book model.
     *
     * @var User class
     */
    protected $book;

    /**
     * Construct
     *
     * @param Book $book
     * @param User $user
     * @param FileBook $filebook
     */
    public function __construct(Book $book)
    {
        $this->book = $book;
    }

    /**
     * Show page your library
     * @return [type] [description]
     */
    public function yourLibrary() {
        $bookLibrarys = $this->book->getBookLibraryBelongUser(Auth::user()->id);
        return view('frontend.yourlibrary',compact('bookLibrarys'));
    }

}
