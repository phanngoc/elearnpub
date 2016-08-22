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
use App\Models\Bundle;
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
     * Bundle model.
     *
     * @var Bundle class
     */
    protected $bundle;

    /**
     * Construct
     *
     * @param Book $book
     * @param User $user
     * @param FileBook $filebook
     */
    public function __construct(Book $book, User $user, FileBook $filebook, Price $price, Resource $resource,
                                Category $category, Language $language, Cart $cart, Bundle $bundle)
    {
        $this->book = $book;
        $this->user = $user;
        $this->filebook = $filebook;
        $this->price = $price;
        $this->resource = $resource;
        $this->category = $category;
        $this->language = $language;
        $this->cart = $cart;
        $this->bundle = $bundle;
    }

    /**
     * Load page home
     * @return [type] [description]
     */
    public function index()
    {
       $bookBestsellers = $this->book->bestsellerBook()->get();
       $bookfeatures = $this->book->featureBook()->get();

       $categories = $this->category->all();
       $languages = $this->language->all();

       return view('frontend.home', compact('bookBestsellers', 'bookfeatures', 'categories', 'languages'));
    }

    public function test()
    {
      echo Markdown::parse('# Chapter 1 Hello, world!');
    }

    /**
     * Return book is searched by category and language.
     * @param  [int] $cateid Category id.
     * @param  [int] $langid Language id.
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
     * Show bestselling book page.
     * @return [type] [description]
     */
    public function bestSellingBook($filter, $cateid, $langid) {
      $categories = $this->category->all();
      $languages = $this->language->all();

      $category = $this->category->findOrNull($cateid);
      $language = $this->language->findOrNull($langid);

      $books = $this->book->chooseFilter($filter)
                          ->bookWithLanguageAndCategory($cateid, $langid)
                          ->paginate(8);

      $bookFilter = array(
        'this_week_best_seller' => 'This Week\'s Best Sellers',
        'lifetime_best_seller' => 'Lifetime Best Sellers',
        'this_week_popular_book' => 'This Week\'s Popular Books.',
        'lifetime_popular_book' => 'Lifetime Popular Books.',
        'recently_updated' => 'Recently Updated',
        'first_published' => 'First Published'
      );

      return view('frontend.home.bestselling', compact('books', 'categories', 'languages',
                                                       'category', 'language', 'bookFilter', 'filter'));
    }

    /**
     * Show best selling bundle.
     * @return [type] [description]
     */
    public function bestSellingBundle($filter) {

      $bundles = $this->bundle->chooseFilter($filter)
                          ->paginate(8);

      $bundleFilter = array(
        'this_week_best_seller' => 'This Week\'s Best Sellers',
        'lifetime_best_seller' => 'Lifetime Best Sellers',
        'this_week_popular_bundle' => 'This Week\'s Popular Bundles.',
        'lifetime_popular_bundle' => 'Lifetime Popular Bundles.',
        'recently_updated' => 'Recently Updated',
        'first_published' => 'First Published'
      );

      return view('frontend.home.bestselling_bundle', compact('bundles', 'bundleFilter', 'filter'));
    }

    /**
     * Show search page with press search
     * @param  [string] $keyword Keywork to search.
     * @return [Response]          [description]
     */
    public function showPageSearch(Request $request)
    {
      $keyword = $request->input('search');
      $categories = $this->category->all();
      $languages = $this->language->all();
      $books = DB::table('books')
                ->where('title', 'like', '%'.$keyword.'%')
                ->paginate(8);
      return view('frontend.search', compact('books', 'categories', 'languages', 'keyword'));
    }
}
