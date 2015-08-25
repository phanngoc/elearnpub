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
use Validator;
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

  /**
   * [addCoAuthor description]
   * @param [type] $book_id [description]
   */
  public function addCoAuthor($book_id)
  {
    $book = Book::find($book_id);
    $linkfilecss = 'add_coauthor.css';
    return view('frontend.author.add_coauthor',compact('book','linkfilecss'));
  }

  /**
   * [postAddCoAuthor description]
   * @param  [type] $book_id [description]
   * @return [type]          [description]
   */
  public function postAddCoAuthor($book_id,Request $request)
  {
    $validator = Validator::make($request->all(),[
        'username' => 'required|max:255|exists:users,username',
        'royalty' => 'required|digits_between:0,100',
    ]);
    if($validator->fails())
    {
      return redirect()->route('add_coauthor',$book_id)->withErrors($validator,'coauthor')->withInput();  
    }
    $book = Book::find($book_id);
    User::connectCoAuthor($request->all(),$book_id);
    return redirect()->route('add_coauthor',$book_id);
  }

  /**
   * [editCoAuthor description]
   * @param  [type] $book_id [description]
   * @return [type]          [description]
   */
  public function editCoAuthor($book_id)
  {
    $book = Book::find($book_id);
    $linkfilecss = 'edit_coauthor.css';
    $infoCoAuthor = Book::findCoAuthor($book_id);
    return view('frontend.author.edit_coauthor',compact('book','infoCoAuthor','linkfilecss'));
  }

  /**
   * [deleteCoAuthor description]
   * @param  [type] $book_id   [description]
   * @param  [type] $author_id [description]
   * @return [type]            [description]
   */
  public function deleteCoAuthor($book_id,$author_id)
  {
    Book::deleteCoAuthor($book_id,$author_id);
    return redirect()->route('edit_coauthor',$book_id);
  }

  /**
   * [addContributor description]
   * @param [type] $book_id [description]
   */
  public function addContributor($book_id)
  {
    $book = Book::find($book_id);
    $linkfilecss = 'add_contributor.css';
    return view('frontend.author.add_contributor',compact('book','linkfilecss'));
  }

  /**
   * [generateRandomString description]
   * @param  integer $length [description]
   * @return [type]          [description]
   */
  public function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }

  /**
   * [postAddContributor description]
   * @param  [type]  $book_id [description]
   * @param  Request $request [description]
   * @return [type]           [description]
   */
  public function postAddContributor($book_id,Request $request)
  {
    if($request->input('username') != '')
    {
      Book::addContributorByUsername($book_id,$request->input('username'));
    }
    else
    {
      $validator = Validator::make($request->all(),[
          'name' => 'required|max:50',
          'blurb' => 'required',
          'email' => 'required|email|unique:users,email',
          'twitter_id' => 'required|unique:users,twitter_id',
      ]);

      if($validator->fails())
      {
        return redirect()->route('add_contributor',$book_id)->withErrors($validator,'cocontributor')->withInput();  
      }

      $destinationPath = public_path().'/avatar/';
      dd($destinationPath);
      $fileName = $this->generateRandomString(12);
      if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {       
          $request->file('avatar')->move($destinationPath, $fileName);
      }
      else
      {
        $fileName = 'default-avatar.png';
      }
      User::createContributorAndConnectBook($book_id,$request->all(),$fileName);
    }
    return redirect()->route('add_contributor',$book_id);
  }
}
