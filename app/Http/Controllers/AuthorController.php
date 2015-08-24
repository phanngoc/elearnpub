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

class AuthorController extends Controller
{

  /**
   * [customAuthorName description]
   * @param  [type] $book_id [description]
   * @return [type]          [description]
   */
  public function customAuthorName($book_id)
  {
    $linkfilecss = 'custom_author_name.css';
    $book = Book::find($book_id);
    return view('frontend.author.custom_author',compact('book','linkfilecss'));
  }

  /**
   * [updateCustomAuthorName description]
   * @param  [type] $book_id [description]
   * @return [type]          [description]
   */
  public function updateCustomAuthorName($book_id,Request $request)
  {
    Book::find($book_id)->update(['custom_author_name'=>$request->input('custom_author_name')]);
    return redirect()->route('custom_author_name',$book_id);
  }

}
