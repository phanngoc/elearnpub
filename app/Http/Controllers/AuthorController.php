<?php
namespace App\Http\Controllers;

use \Illuminate\Http\Request;
use DB;
use File;
use Validator;

use App\User;
use App\Models\Book;
use App\Models\Price;
use App\Models\Package;
use App\Models\Extrafile;
use App\Models\Extra;
use App\Models\Category;
use App\Models\Language;
use App\Models\Filebook;
use App\Models\Resource;

class AuthorController extends Controller
{
  /**
   * Book model.
   *
   * @var Book class
   */
  protected $book;

  /**
   * Filebook model.
   *
   * @var Filebook class
   */
  protected $filebook;

  /**
   * User model.
   *
   * @var User class
   */
  protected $user;

  /**
   * Price model.
   *
   * @var Price class
   */
  protected $price;

  /**
   * Resource model.
   *
   * @var Price class
   */
  protected $resource;

  /**
   * Construct
   *
   * @param Book $book
   * @param User $user
   * @param FileBook $filebook
   */
  public function __construct(Book $book, User $user, FileBook $filebook, Price $price, Resource $resource)
  {
      $this->book = $book;
      $this->user = $user;
      $this->filebook = $filebook;
      $this->price = $price;
      $this->resource = $resource;
  }

  /**
   * Show page custom author name.
   * @param  [int] $book_id [description]
   * @return [type]          [description]
   */
  public function customAuthorName($book_id)
  {
    $linkfilecss = 'custom_author_name.css';
    $book = $this->book->find($book_id);
    return view('frontend.author.custom_author',compact('book','linkfilecss'));
  }

  /**
   * Post update custom author name.
   * @param  [int] $book_id Id of book.
   * @return [Illuminate\Http\RedirectResponse] response
   */
  public function updateCustomAuthorName($book_id, Request $request)
  {
    $this->book->find($book_id)->update(['custom_author_name' => $request->input('custom_author_name')]);
    return redirect()->route('custom_author_name',$book_id);
  }

  /**
   * Show page add collaborator who write book.
   * @param [int] $book_id [description]
   * @return [Illuminate\Http\Response] response
   */
  public function addCoAuthor($book_id)
  {
    $book = $this->book->find($book_id);
    $linkfilecss = 'add_coauthor.css';
    return view('frontend.author.add_coauthor',compact('book','linkfilecss'));
  }

  /**
   * Post add collaborator who write book.
   * @param  [int] $book_id Id of book.
   * @return [Illuminate\Http\RedirectResponse] response
   */
  public function postAddCoAuthor($book_id, Request $request)
  {
    $validator = Validator::make($request->all(),[
        'username' => 'required|max:255|exists:users,username',
        'royalty' => 'required|digits_between:0,100',
    ]);

    if($validator->fails())
    {
      return redirect()->route('add_coauthor',$book_id)->withErrors($validator,'coauthor')->withInput();
    }

    $book = $this->book->find($book_id);
    $this->user->connectCoAuthor($request->all(),$book_id);
    return redirect()->route('add_coauthor',$book_id);
  }

  /**
   * Show view edit collaborator.
   * @param  [int] $book_id
   * @return [Illuminate\Http\Response] response
   */
  public function editCoAuthor($book_id)
  {
    $book = $this->book->find($book_id);
    $linkfilecss = 'edit_coauthor.css';
    $infoCoAuthor = $this->book->findCoAuthor($book_id);
    return view('frontend.author.edit_coauthor', compact('book', 'infoCoAuthor', 'linkfilecss'));
  }

  /**
   * Delete collaborator from book.
   * @param  [type] $book_id   [description]
   * @param  [type] $author_id [description]
   * @return [type]            [description]
   */
  public function deleteCoAuthor($book_id, $author_id)
  {
    $this->book->deleteCoAuthor($book_id, $author_id);
    return redirect()->route('edit_coauthor', $book_id);
  }

  /**
   * Show view add contributor to book.
   * @param [int] $book_id [description]
   */
  public function addContributor($book_id)
  {
    $book = $this->book->find($book_id);
    $linkfilecss = 'add_contributor.css';
    return view('frontend.author.add_contributor', compact('book','linkfilecss'));
  }

  /**
   * [postAddContributor description]
   * @param  [type]  $book_id [description]
   * @param  Request $request [description]
   * @return [type]           [description]
   */
  public function postAddContributor($book_id, Request $request)
  {
    if ($request->input('username') != '')
    {
      $this->book->addContributorByUsername($book_id, $request->input('username'));
    }
    else
    {
      $validator = Validator::make($request->all(),[
          'name' => 'required|max:50',
          'blurb' => 'required',
          'email' => 'required|email|unique:users,email',
          'twitter_id' => 'required|unique:users,twitter_id',
          'avatar' => 'image',
      ]);

      if ($validator->fails())
      {
        return redirect()->route('add_contributor', $book_id)->withErrors($validator, 'cocontributor')->withInput();
      }

      if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
          $destinationPath = public_path().'/avatar/';
          $fileName = generateRandomString(12);
          $original_name = $request->file('avatar')->getClientOriginalName();
          $extension = '';

          if(array_key_exists("extension", pathinfo($original_name)))
          {
            $extension = pathinfo($original_name)['extension'];
          }
          $request->file('avatar')->move($destinationPath, $fileName.'.'.$extension);
      }
      else
      {
        $fileName = 'default-avatar.png';
      }
      $this->user->createContributorAndConnectBook($book_id,$request->all(),$fileName);
    }
    return redirect()->route('add_contributor',$book_id);
  }

  /**
   * List all contributor of book.
   * @param  [type] $book_id [description]
   * @return [type]          [description]
   */
  public function listContributor($book_id)
  {
    $book = $this->book->find($book_id);
    $linkfilecss = 'list_contributor.css';
    $contributors = $this->book->getContributorOfBook($book_id);
    return view('frontend.author.list_contributor',compact('book', 'linkfilecss', 'contributors'));
  }

  /**
   * Show page edit contributor.
   * @param  [int] $book_id   [description]
   * @param  [int] $author_id [description]
   * @return [type]            [description]
   */
  public function showEditContributor($book_id, $author_id)
  {
    $book = $this->book->find($book_id);
    $linkfilecss = 'show_edit_contributor.css';
    $contributor = $this->user->find($author_id);
    return view('frontend.author.show_edit_contributor', compact('book','linkfilecss','contributor'));
  }

  /**
   * [postShowEditContributor description]
   * @param  [type]  $book_id [description]
   * @param  [type]  $author_id [description]
   * @param  Request $request [description]
   * @return [type]           [description]
   */
  public function postShowEditContributor($book_id,$author_id,Request $request)
  {
    if ($request->input('username') != '')
    {
      $this->book->editContributorByUsername($book_id, $author_id, $request->input('username'));
    }
    else
    {
      $validator = Validator::make($request->all(),[
          'name' => 'required|max:50',
          'blurb' => 'required',
          'email' => 'required|email',
          'twitter_id' => 'required',
          'avatar' => 'image',
      ]);

      if ($validator->fails())
      {
        return redirect()->route('show_edit_contributor',array('book_id'=>$book_id, 'author_id'=>$author_id))
                                  ->withErrors($validator, 'cocontributor')->withInput();
      }

      if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
          $destinationPath = public_path().'/avatar/';
          $fileName = $this->generateRandomString(12);
          $original_name = $request->file('avatar')->getClientOriginalName();
          $extension = '';
          if(array_key_exists("extension",pathinfo($original_name)))
          {
            $extension = pathinfo($original_name)['extension'];
          }
          $request->file('avatar')->move($destinationPath, $fileName.'.'.$extension);
      }
      else
      {
        $fileName = 'default-avatar.png';
      }
      $this->user->updateContributorAndConnectBook($author_id,$request->all(),$fileName);
    }
    return redirect()->route('show_edit_contributor',array('book_id'=>$book_id,'author_id'=>$author_id));
  }


  public function addCoupon($bookId)
  {
    $book = $this->book->find($bookId);
    $linkfilecss = 'add_coupon.css';
    $packages = Package::getPackageBelongBook($bookId);
    return view('frontend.author.add_coupon',compact('book','linkfilecss','packages'));
  }
}
