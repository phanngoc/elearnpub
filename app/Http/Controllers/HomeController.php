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
     * Cart model.
     *
     * @var Cart class
     */
    protected $cart;

    /**
     * Construct
     *
     * @param Book $book
     * @param User $user
     * @param FileBook $filebook
     */
    public function __construct(Book $book, User $user, FileBook $filebook, Price $price, Resource $resource,
                                Category $category, Language $language, Cart $cart)
    {
        $this->book = $book;
        $this->user = $user;
        $this->filebook = $filebook;
        $this->price = $price;
        $this->resource = $resource;
        $this->category = $category;
        $this->language = $language;
        $this->cart = $cart;
    }

    /**
     * Load page home
     * @return [type] [description]
     */
    public function index()
    {
       $carts = $this->cart->all();
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
          $currentBook = $this->book->find($keyIdBook);
          $currentBook['meta'] = $this->book->getMainAuthor($currentBook->id);
  	      array_push($books, $currentBook);
  	   }

       $bookfeatures = $this->book->orderBy('publisted_at')->get();

       foreach ($bookfeatures as $keyBookFe => $bookfeature) {
          $bookfeatures[$keyBookFe]['meta'] = $this->book->getMainAuthor($bookfeature->id);
       }

       $categories = $this->category->all();
       $languages = $this->language->all();

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
        $categories = $this->category->all();
        $languages = $this->language->all();

        $category = null;
        $book = null;
        $language = null;

        if ($cateid == 'all' && $langid == 'all') {
           $books = DB::table('books')->paginate(8);
        }
        elseif ($cateid != 'all' && $langid == 'all') {
           $category = $this->category->find($cateid);
           $books = DB::table('books')->join('book_category', 'book_category.book_id','=','books.id')
                                      ->where('category_id', $cateid)->paginate(8);
        }
        elseif ($cateid == 'all' && $langid != 'all') {
           $language = $this->language->find($langid);
           $books = DB::table('books')->where('language_id', $langid)->paginate(8);
        }
        elseif ($cateid != 'all' && $langid != 'all') {
           $category = $this->category->find($cateid);
           $language = $this->language->find($langid);
           $books = DB::table('books')->join('book_category', 'book_category.book_id', '=', 'books.id')
                                      ->where('category_id', $cateid)->where('language_id', $langid)
                                      ->paginate(8);
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
      $categories = $this->category->all();
      $languages = $this->language->all();
      $books = DB::table('books')
                ->where('title', 'like', '%'.$keyword.'%')
                ->paginate(8);
      return view('frontend.search', compact('books','categories','languages','keyword'));
    }
}
