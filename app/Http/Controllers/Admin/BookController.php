<?php
namespace App\Http\Controllers\Admin;

use \Illuminate\Http\Request;
use DB;
use File;
use Validator;
use App\Http\Controllers\Controller;
use App\Repositories\BookRepository;

class BookController extends AdminController
{
  private $bookRepository;

  function __construct(BookRepository $bookRepository) {
    $this->bookRepository = $bookRepository;
  }

  /**
   * Return list book.
   * @return [type] [description]
   */
  public function listBooks() {
    $pagiListBooks = $this->bookRepository->listBooks();

    $results = array(
      'items' => $pagiListBooks->items(),
      'currentPage' => $pagiListBooks->currentPage(),
      'total' => $pagiListBooks->total()
    );

    return $this->responseSuccess(200, $results);
  }

  /**
   * Change status publish of book.
   * @param  Request $request [description]
   * @return [type]           [description]
   */
  public function publishBook(Request $request) {
    $bookId = $request->input('book_id');
    $isAllowed = $request->input('is_allowed') == "true" ? "1" : "0" ;
    $results = $this->bookRepository->update(['allow_published' => $isAllowed], $bookId);
    return $this->responseSuccess(200, $results);
  }

  /**
   * Get book detail.
   * @param  Request $request [description]
   * @return [type]           [description]
   */
  public function findBook($bookId, Request $request) {
    $results = $this->bookRepository->find($bookId);
    return $this->responseSuccess(200, $results);
  }

}
