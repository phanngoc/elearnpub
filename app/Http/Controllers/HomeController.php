<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Book;
use App\Models\Resource;
use App\Models\Price;
use App\Models\Filebook;
use App\Models\Category;
use App\Models\Language;
use App\Models\Bill;
use App\User;
use Markdown;
use Illuminate\Http\Request;
use File;
use Session;
use DB;
use Auth;
use Validator;
use Redirect;
use URL;

class HomeController extends Controller
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
     * Load page home
     * @return [type] [description]
     */
    public function index()
    {
       $carts = Cart::all();
       $arrIdBooks = array();

       foreach ($carts as $cart) {
       	  if (!array_key_exists($cart->book_id, $arrIdBooks))
       	  {
       	  	$arrIdBooks += array($cart->book_id => $cart->count);
       	  }
       	  else
       	  {
       	  	$arrIdBooks[$cart->book_id] += $cart->count;
       	  }
       }

  	   arsort($arrIdBooks);
  	   $books = array();

  	   foreach ($arrIdBooks as $keyIdBook => $valueIdBook) {
          $currentBook = Book::find($keyIdBook);
          $currentBook['meta'] = $this->book->getMainAuthor($currentBook->id);
  	      array_push($books, $currentBook);
  	   }

       $bookfeatures = Book::orderBy('publisted_at')->get();
       foreach ($bookfeatures as $keyBookFe => $bookfeature) {
          $bookfeatures[$keyBookFe]['meta'] = $this->book->getMainAuthor($bookfeature->id);
       }

       $categories = Category::all();
       $languages = Language::all();

       return view('frontend.home', compact('books', 'bookfeatures', 'categories', 'languages'));
    }

    public function test()
    {
      echo Markdown::parse('# Chapter 1 Hello, world!');
    }

    /**
     * Return book is searched by category and language.
     * @param  [int] $cateid Category id.
     * @param  [type] $langid Language id.
     * @return [type]         [description]
     */
    public function searchCateAndLang($cateid, $langid)
    {
        $categories = Category::all();
        $languages = Language::all();
        $category = null;
        $book = null;
        $language = null;

        if ($cateid == 'all' && $langid == 'all') {
          $books = DB::table('books')->paginate(8);
        }
        elseif ($cateid != 'all' && $langid == 'all') {
           $category = Category::find($cateid);
           $books = DB::table('books')->join('book_category', 'book_category.book_id','=','books.id')->where('category_id', $cateid)->paginate(8);
        }
        elseif ($cateid == 'all' && $langid != 'all') {
           $language = Language::find($langid);
           $books = DB::table('books')->where('language_id', $langid)->paginate(8);
        }
        elseif ($cateid != 'all' && $langid != 'all') {
           $category = Category::find($cateid);
           $language = Language::find($langid);
           $books = DB::table('books')->join('book_category', 'book_category.book_id', '=', 'books.id')->where('category_id', $cateid)->where('language_id', $langid)->paginate(8);
        }

        return view('frontend.category', compact('books', 'categories', 'languages', 'category', 'language'));
    }

    /**
     * Show search page with press search
     * @param  [string] $keyword Keywork to search.
     * @return [type]          [description]
     */
    public function showPageSearch(Request $request)
    {
      $keyword = $request->input('search');
      $categories = Category::all();
      $languages = Language::all();
      $books = DB::table('books')
                ->where('title', 'like', '%'.$keyword.'%')
                ->paginate(8);
      return view('frontend.search', compact('books','categories','languages','keyword'));
    }
}
