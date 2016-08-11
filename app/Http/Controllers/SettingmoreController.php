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
  public function __construct(Book $book, Language $language, Category $category)
  {
      $this->book = $book;
      $this->language = $language;
      $this->category = $category;
  }

  /**
   * Category.
   * @param  [type] $book_id [description]
   * @return [type]          [description]
   */
  public function category($book_id)
  {
    $linkfilecss = 'settingmore.css';
    $book = $this->book->find($book_id);
    $categories = $this->category->all();

    $categoriesBelongBook = $this->book->getCategory($book_id);
    $cateSelect = array();
    foreach ($categoriesBelongBook as $key => $value) {
      array_push($cateSelect,$value->id);
    }
    return view('frontend.settingmore.category', compact('book', 'categories', 'cateSelect', 'linkfilecss'));
  }

  /**
   * [updateCategory description]
   * @param  [type]  $book_id [description]
   * @param  Request $request [description]
   * @return [type]           [description]
   */
  public function updateCategory($book_id, Request $request)
  {
    $categories = $request->input('category');
    $this->book->find($book_id)->category()->sync($categories);
    return redirect()->route('category',$book_id);
  }

  public function language($book_id)
  {
    $linkfilecss = 'language.css';
    $book = $this->book->find($book_id);
    $languages = $this->language->all();
    return view('frontend.settingmore.language',compact('book','languages','linkfilecss'));
  }

  public function updateLanguage($book_id, Request $request)
  {
    $book = $this->book->find($book_id);
    $book->update(['language_id'=>$request->input('language')]);
    return redirect()->route('language',$book_id);
  }
}
