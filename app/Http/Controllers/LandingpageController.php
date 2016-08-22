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
   * Book model.
   *
   * @var Book class
   */
  protected $book;

  /**
   * __construct description
   * @param Book     $book     [description]
   */
  public function __construct(Book $book)
  {
      $this->book = $book;
  }

  /**
   * Load landing page.
   * @param  [int] $book_id [description]
   * @return [type]          [description]
   */
  public function index($book_id)
  {
    $linkfilecss = 'landingpage.css';
    $book = $this->book->find($book_id);
    return view('frontend.landingpage.landingpage',compact('book','linkfilecss'));
  }

  /**
   * Update langding page.
   * @param  [type]  $book_id [description]
   * @param  Request $request [description]
   * @return [type]           [description]
   */
  public function updateLandingPage($book_id,Request $request)
  {
    $this->book->find($book_id)->update($request->all());
    return redirect()->route('landing_page',$book_id);
  }

  /**
   * View show percent complete.
   * @param  [int] $book_id [description]
   * @return [type]          [description]
   */
  public function percentComplete($book_id)
  {
    $linkfilecss = 'percent_complete.css';
    $book = $this->book->find($book_id);
    return view('frontend.landingpage.percent_complete',compact('book','linkfilecss'));
  }

  /**
   * Update percent complete.
   * @param  [int]  $book_id
   * @param  Request $request [description]
   * @return [type]           [description]
   */
  public function updatePercentComplete($book_id, Request $request)
  {
    $this->book->find($book_id)->update($request->all());
    return redirect()->route('percent_complete', $book_id);
  }

}
