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

class LandingpageController extends Controller
{

  /**
   * [index description]
   * @param  [type] $book_id [description]
   * @return [type]          [description]
   */
  public function index($book_id)
  {
    $linkfilecss = 'landingpage.css';
    $book = Book::find($book_id);
    return view('frontend.landingpage.landingpage',compact('book','linkfilecss'));
  }

  /**
   * [updateLandingPage description]
   * @param  [type]  $book_id [description]
   * @param  Request $request [description]
   * @return [type]           [description]
   */
  public function updateLandingPage($book_id,Request $request)
  {
    Book::find($book_id)->update($request->all());
    return redirect()->route('landing_page',$book_id);
  }

  /**
   * [percent_complete description]
   * @param  [type] $book_id [description]
   * @return [type]          [description]
   */
  public function percentComplete($book_id)
  {
    $linkfilecss = 'percent_complete.css';
    $book = Book::find($book_id);
    return view('frontend.landingpage.percent_complete',compact('book','linkfilecss'));
  }

  /**
   * [updatePercentComplete description]
   * @param  [type]  $book_id [description]
   * @param  Request $request [description]
   * @return [type]           [description]
   */
  public function updatePercentComplete($book_id,Request $request)
  {
    Book::find($book_id)->update($request->all());
    return redirect()->route('percent_complete',$book_id);
  }

}
