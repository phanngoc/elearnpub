<?php
namespace App\Http\Controllers;

use App\User;
use App\Models\Book;
use App\Models\Price;
use App\Models\Package;
use App\Models\Category;
use App\Models\Language;
use App\Models\Extrafile;
use App\Models\Extra;
use App\Repositories\BookRepository;

use \Illuminate\Http\Request;
use File;
use DB;


class SettingmoreController extends Controller
{

  /**
   * Book model.
   *
   * @var User class
   */
  protected $book;

  /**
   * Book repository.
   *
   * @var Book class
   */
  protected $bookRepository;

  /**
   * Category model.
   *
   * @var Category class
   */
  protected $category;

  /**
   * Language model.
   *
   * @var Language class
   */
  protected $language;

  /**
   * Construct
   *
   * @param Book $book
   * @param Category $category
   * @param Language $language
   */
  public function __construct(Book $book, BookRepository $bookRepository, Language $language, Category $category)
  {
      $this->book = $book;
      $this->language = $language;
      $this->category = $category;
      $this->bookRepository = $bookRepository;
  }

  /**
   * Category.
   * @param  [type] $book_id [description]
   * @return [type]          [description]
   */
  public function category($bookId)
  {
    $book = $this->bookRepository->findBookWithCategories($bookId);
    $categories = $this->category->all();

    return view('frontend.settingmore.category', compact('book', 'categories'));
  }

  /**
   * [updateCategory description]
   * @param  [type]  $book_id [description]
   * @param  Request $request [description]
   * @return [type]           [description]
   */
  public function updateCategory($bookId, Request $request)
  {
    $categories = $request->input('category');
    $this->bookRepository->syncCategories($bookId, $categories);
    return redirect()->route('category', $bookId);
  }

  /**
   * Show page setting language.
   * @param  [type] $book_id [description]
   * @return [type]          [description]
   */
  public function language($bookId)
  {
    $book = $this->bookRepository->find($bookId);
    $languages = $this->language->all();
    return view('frontend.settingmore.language',compact('book', 'languages'));
  }

  /**
   * Update language.
   * @param  [int]  $book_id [description]
   * @param  Request $request [description]
   * @return [type]           [description]
   */
  public function updateLanguage($bookId, Request $request)
  {
    $this->bookRepository->update(['language_id' => $request->input('language')], $bookId);
    return redirect()->route('language', $bookId);
  }
}
