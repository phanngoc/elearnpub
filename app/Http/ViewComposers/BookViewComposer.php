<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Repositories\BookRepository;
use Input;

class BookViewComposer
{

    /**
     * Book repository model.
     * @var BookRepository class
     */
    private $bookRepository;

    /**
     * [$request description]
     * @var [type]
     */
    private $request;

    /**
     * Create a new css composer.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(BookRepository $bookRepository, Request $request)
    {
      $this->bookRepository = $bookRepository;
      $this->request = $request;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if ($bookId = $this->request->id) {
          $book = $this->bookRepository->find($bookId);
          view()->share('book', $book);
        }
    }
}
