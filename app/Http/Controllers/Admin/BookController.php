<?php
namespace App\Http\Controllers\Admin;

use \Illuminate\Http\Request;
use DB;
use File;
use Validator;
use App\Http\Controllers\Controller;
use App\Repositories\BookRepository;
use App\Repositories\LanguageRepository;
use App\Http\Requests\UpdateBookRequest;

class BookController extends AdminController
{
  private $bookRepository;

  private $languageRepository;

  function __construct(BookRepository $bookRepository, LanguageRepository $languageRepository) {
    $this->bookRepository = $bookRepository;
    $this->languageRepository = $languageRepository;
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
    $results->languages = $this->languageRepository->all();
    return $this->responseSuccess(200, $results);
  }

  /**
   * Update book detail.
   * @param  Request $request
   * @return [type]           [description]
   */
  public function update($bookId, UpdateBookRequest $request) {
    $results = $this->bookRepository->update($request->all(), $bookId);
    return $this->responseSuccess(200, $results);
  }
}
