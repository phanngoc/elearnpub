<?php
namespace App\Http\Controllers;

use App\User;
use App\Models\Book;
use App\Models\Price;
use App\Models\Package;
use DB;
use App\Models\Extrafile;
use File;
use App\Models\Extra;
use \Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Language;

class SettingmoreController extends Controller
{

  /**
   * [category description]
   * @param  [type] $book_id [description]
   * @return [type]          [description]
   */
  public function category($book_id)
  {
    $linkfilecss = 'settingmore.css';
    $book = Book::find($book_id);
    $categories = Category::all();

    $categoriesBelongBook = Book::getCategory($book_id);
    $cateSelect = array();
    foreach ($categoriesBelongBook as $key => $value) {
      array_push($cateSelect,$value->id);
    }
    return view('frontend.settingmore.category',compact('book','categories','cateSelect','linkfilecss'));
  }

  /**
   * [updateCategory description]
   * @param  [type]  $book_id [description]
   * @param  Request $request [description]
   * @return [type]           [description]
   */
  public function updateCategory($book_id,Request $request)
  {
    $categories = $request->input('category');
    Book::find($book_id)->category()->sync($categories);
    return redirect()->route('category',$book_id);
  }

  public function language($book_id)
  {
    $linkfilecss = 'language.css';
    $book = Book::find($book_id);
    $languages = Language::all();
    return view('frontend.settingmore.language',compact('book','languages','linkfilecss'));
  }

  public function updateLanguage($book_id,Request $request)
  {
    $book = Book::find($book_id);
    $book->update(['language_id'=>$request->input('language')]);
    return redirect()->route('language',$book_id);
  }
}
