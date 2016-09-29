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

use App\Repositories\BookAuthorRepository;
use App\Repositories\BookRepository;
use App\Repositories\CouponRepository;

use App\Services\BookService;

use App\Http\Requests\CreateCouponRequest;

class AuthorController extends Controller
{
  /**
   * Book repository model.
   *
   * @var BookRepository class
   */
  protected $bookRepository;

  /**
   * Book service.
   * @var BookService class
   */
  protected $bookService;

  /**
   * Coupon repository model.
   * @var CouponRepository class
   */
  protected $couponRepository;

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
   * Book author Repository.
   *
   * @var BookAuthorRepository class
   */
  protected $bookAuthorRepository;

  /**
   * Construct
   *
   * @param Book $book
   * @param User $user
   * @param FileBook $filebook
   */
  public function __construct(BookRepository $bookRepository,
                              CouponRepository $couponRepository,
                              BookService $bookService,
                              BookAuthorRepository $bookAuthorRepository,
                              User $user, FileBook $filebook, Price $price,
                              Resource $resource)
  {
      $this->bookRepository = $bookRepository;
      $this->user = $user;
      $this->filebook = $filebook;
      $this->price = $price;
      $this->resource = $resource;
      $this->bookAuthorRepository = $bookAuthorRepository;
      $this->bookService = $bookService;
      $this->couponRepository = $couponRepository;
  }

  /**
   * Show page custom author name.
   * @param  [int] $book_id [description]
   * @return [type]          [description]
   */
  public function customAuthorName($bookId)
  {
    $book = $this->bookRepository->find($bookId);
    return view('frontend.author.custom_author', compact('book'));
  }

  /**
   * Post update custom author name.
   * @param  [int] $book_id Id of book.
   * @return [Illuminate\Http\RedirectResponse] response
   */
  public function updateCustomAuthorName($bookId, Request $request)
  {
    $this->bookRepository->update(['custom_author_name' => $request->input('custom_author_name')], $bookId);
    return redirect()->route('custom_author_name', $bookId);
  }

  /**
   * Show page add collaborator who write book.
   * @param [int] $book_id [description]
   * @return [Illuminate\Http\Response] response
   */
  public function addCoAuthor($bookId)
  {
    $book = $this->bookRepository->find($bookId);
    return view('frontend.author.add_coauthor',compact('book'));
  }

  /**
   * Post add collaborator who write book.
   * @param  [int] $book_id Id of book.
   * @return [Illuminate\Http\RedirectResponse] response
   */
  public function postAddCoAuthor($bookId, Request $request)
  {
    $validator = Validator::make($request->all(),[
        'username' => 'required|max:255|exists:users,username',
        'royalty' => 'required|digits_between:0,100',
    ]);

    if($validator->fails())
    {
      return redirect()->route('add_coauthor',$bookId)
              ->withErrors($validator, 'coauthor')->withInput();
    }

    $this->bookService->addCoAuthorToBook($request->all(), $bookId);
    return redirect()->route('add_coauthor', $bookId);
  }

  /**
   * Show view edit collaborator.
   * @param  [int] $book_id
   * @return [Illuminate\Http\Response] response
   */
  public function editCoAuthor($bookId)
  {
    $book = $this->bookRepository->findBookWithMainAndCoAuthor($bookId);
    return view('frontend.author.edit_coauthor', compact('book'));
  }

  /**
   * Delete collaborator from book.
   * @param  [type] $book_id   [description]
   * @param  [type] $author_id [description]
   * @return [type]            [description]
   */
  public function deleteCoAuthor($bookId, $authorId)
  {
    $this->bookAuthorRepository->deleteCoAuthor($book_id, $author_id);
    return redirect()->route('edit_coauthor', $book_id);
  }

  /**
   * Show view add contributor to book.
   * @param [int] $book_id [description]
   */
  public function addContributor($bookId)
  {
    $book = $this->bookRepository->find($bookId);
    return view('frontend.author.add_contributor', compact('book'));
  }

  /**
   * [postAddContributor description]
   * @param  [type]  $book_id [description]
   * @param  Request $request [description]
   * @return [type]           [description]
   */
  public function postAddContributor($bookId, Request $request)
  {
    $input = $request->all();
    if ($input['username'] != '')
    {
      $this->bookService->createContributorByUsername($bookId, $input['username']);
    }
    else
    {
      $validator = Validator::make($input, [
          'name' => 'required|max:50',
          'blurb' => 'required',
          'email' => 'required|email|unique:users,email',
          'twitter_id' => 'required|unique:users,twitter_id',
          'avatar' => 'image',
      ]);

      if ($validator->fails())
      {
        return redirect()->route('add_contributor', $bookId)->withErrors($validator, 'cocontributor')->withInput();
      }

      if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
          $destinationPath = config('common.url_upload');
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
      $input['avatar'] = $fileName;
      $this->bookService->createContributorAndConnectBook($bookId, $input);
    }
    return redirect()->route('add_contributor', $bookId);
  }

  /**
   * List all contributor of book.
   * @param  [type] $book_id [description]
   * @return [type]          [description]
   */
  public function listContributor($book_id)
  {
    $book = $this->book->find($book_id);
    $contributors = $this->book->getContributorOfBook($book_id);
    return view('frontend.author.list_contributor',compact('book', 'contributors'));
  }

  /**
   * Show page edit contributor.
   * @param  [int] $book_id   [description]
   * @param  [int] $author_id [description]
   * @return [type]            [description]
   */
  public function showEditContributor($bookId, $authorId)
  {
    $book = $this->book->find($bookId);
    $contributor = $this->user->find($authorId);
    return view('frontend.author.show_edit_contributor', compact('book', 'contributor'));
  }

  /**
   * Edit contributor page.
   * @param  [type]  $book_id [description]
   * @param  [type]  $author_id [description]
   * @param  Request $request [description]
   * @return [type]           [description]
   */
  public function postShowEditContributor($bookId, $authorId, Request $request)
  {
    $input = $request->all();

    if ($input['username'] != '')
    {
      $this->bookService->createContributorByUsername($bookId, $input['username']);
    }
    else
    {
      $validator = Validator::make($input, [
          'name' => 'required|max:50',
          'blurb' => 'required',
          'email' => 'required|email',
          'twitter_id' => 'required',
          'avatar' => 'image',
      ]);

      if ($validator->fails())
      {
        return redirect()->route('show_edit_contributor',
                                  array('book_id' => $bookId,
                                        'author_id' => $authorId
                                ))
                                  ->withErrors($validator, 'cocontributor')->withInput();
      }

      if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
          $destinationPath = config('common.url_upload');
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

      $input['filename'] = $fileName;

      $this->bookService->updateContributorAndConnectBook($bookId, $authorId, $input);
    }
    return redirect()->route('show_edit_contributor', array('book_id' => $bookId, 'author_id' => $authorId));
  }
}
