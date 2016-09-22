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
   * Return list user.
   * @return [type] [description]
   */
  public function listBooks() {
    $pagiListBooks = $this->bookRepository->listBooks();

    $results = array(
      'items' => $pagiListBooks->items(),
      'currentPage' => $pagiListBooks->currentPage(),
      'total' => $pagiListBooks->total()
    );
    return $this->responeSuccess(200, $results);
  }
}
