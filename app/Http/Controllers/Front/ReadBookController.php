<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Models\Book;
use App\Models\UserReadBook;
use Validator;
use Zipper;
use App\Http\Controllers\Controller;
use Auth;
use File;

class ReadBookController extends Controller
{
    /**
     * Book model.
     *
     * @var Book class
     */
    protected $book;

    /**
     * User read book model.
     *
     * @var UserReadBook class
     */
    protected $userReadBook;

    /**
     * Construct
     *
     * @param Book $book
     * @param User $user
     * @param FileBook $filebook
     */
    public function __construct(Book $book, UserReadBook $userReadBook)
    {
        $this->book = $book;
        $this->userReadBook = $userReadBook;
    }

    /**
     * Show page read book
     * @return [type] [description]
     */
    public function readbook($id) {

        if (!$this->checkUserCanReadBook($id))
        {
          return redirect()->route('home');
        }

        $book = $this->book->find($id);
        $filebooks = $book->filebooks()->get();
        $contentCombile = '';

        foreach ($filebooks as $key => $value) {
			       $contentCombile .= $value->content;
        }

        return view('frontend.readbook', compact('book', 'contentCombile'));
    }

    /**
     * Check user can read book.
     * @param  [int] $bookId Book 's id.
     * @return [type]         [description]
     */
    private function checkUserCanReadBook($bookId) {
      $userId = Auth::user()->id;
      $check = $this->userReadBook->where('book_id', $bookId)
                          ->where('user_id', $userId)
                          ->where('is_can_read', 1)
                          ->first();
      if ($check == NULL) {
        return false;
      } else {
        return true;
      }
    }

}
