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
     * Load page home
     * @return [type] [description]
     */
    public function index()
    {
       $carts = Cart::all();
       $arrIdBooks = array();

       foreach ($carts as $cart) {
       	  if ( !array_key_exists($cart->book_id, $arrIdBooks) )
       	  {
       	  	$arrIdBooks += array( $cart->book_id => $cart->count );
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
          $currentBook['meta'] = Book::getMainAuthor($currentBook->id);
  	      array_push($books, $currentBook);
  	   }

       $bookfeatures = Book::orderBy('publisted_at')->get();
       foreach ($bookfeatures as $keyBookFe => $bookfeature) {
          $bookfeatures[$keyBookFe]['meta'] = Book::getMainAuthor($bookfeature->id);
       }

       $categories = Category::all();
       $languages = Language::all();

       return view('frontend.home', compact('books', 'bookfeatures', 'categories', 'languages'));
    }

    /**
     * Show book detail page
     * @param  [type] $param [description]
     * @return [type]        [description]
     */
    public function book($param)
    {
      $book = Book::where('bookurl',$param)->first();
      $book->meta = Book::getMainAuthor($book->id);
      $price = new Price;
      $book->price = $price->getPriceByBookId($book->id);
      $resource = new Resource;
      $sample = $resource->getSampleByBook($book->id);
      return view('frontend.detailbook',compact('book','sample'));
    }

    public function test()
    {
      echo Markdown::parse('# Chapter 1 Hello, world!');
    }

    /**
     * Page write book
     * @param  [type] $id       [description]
     * @param  string $namefile [description]
     * @return [type]           [description]
     */
    public function write($id, $namefile='')
    {
      if(!Book::isBookBelongUser($id, Auth::user()->id))
      {
        return redirect()->route('book');
      }
      $currentBook = Book::find($id);
      $files = Book::getFileFromBook($id);
      $filebook = Book::getContentByName($namefile,$files[0]->name);
      return view('frontend.writebook',compact('files','filebook'));
    }

    /**
     * Rename name file in page write book.
     * @param  Request
     * @return [type]
     */
    public function ajax_renamefile(Request $request)
    {
      $filebook = Filebook::find($request->id);
      $filebook->name = $request->name;
      $filebook->save();
    }

    /**
     * Remove file in page write book.
     * @param  Request
     * @return [type]
     */
    public function ajax_removefile(Request $request)
    {
      $filebook = Filebook::find($request->id);
      $dirFile  = base_path() . DIRECTORY_SEPARATOR . 'book' . DIRECTORY_SEPARATOR . $filebook->book_id . DIRECTORY_SEPARATOR . $filebook->link;
      if(File::exists($dirFile))
      {
        File::delete($dirFile);
      }
      $filebook->delete();
    }

    /**
     * Add new file in page write book.
     * @param  Request
     * @return [type]
     */
    public function ajax_newfile(Request $request,$id)
    {
      $namenewfile = $request->namenewfile;

      if( !File::exists(base_path() . DIRECTORY_SEPARATOR . 'book' . DIRECTORY_SEPARATOR . $id) ) {
         File::makeDirectory(base_path() . DIRECTORY_SEPARATOR . 'book' . DIRECTORY_SEPARATOR . $id);
      }

      if (pathinfo($namenewfile, PATHINFO_EXTENSION) == '')
      {
        $namenewfile .= '.txt';
      }

      $file = base_path() . DIRECTORY_SEPARATOR . 'book' . DIRECTORY_SEPARATOR . $id . DIRECTORY_SEPARATOR . $namenewfile;
      File::put($file, '# New Chapter');
      $newbook = Filebook::create([
        'name' => $namenewfile,
        'link' => $namenewfile,
        'content' => '',
        'book_id' => $id,
        'is_sample' => 0,
      ]);

      $response = $newbook;
      unset($response['link']);
      return json_encode($newbook);
    }

    /**
     * Check file is sample.
     * @param  Request
     * @return [type]
     */
    public function ajax_issample(Request $request)
    {
      $file_id = $request->file_id;
      $isSample = $request->isSample;
      $filebook = Filebook::find($file_id);
      $filebook->is_sample = $isSample;
      $filebook->save();
    }

    /**
     * Save content of file.
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function ajax_autoSaveContentFile(Request $request)
    {
      $filebook = Filebook::find($request->file_id);
      $filebook->content = $request->content;
      $filebook->save();
    }

    /**
     * Post data from cart into session.
     * @param  Request $request [description]
     * @return Illuminate\Http\Response
     */
    public function cart(Request $request)
    {
      $item = array('bookid' => $request->bookid, 'amount' => $request->amountYouPay, 'quantity'=>1);
      $carts = $request->session()->get('carts', 'default');
      if( $carts == 'default' )
      {
        $carts = array();
      }

      // if item exist in array cart , only need increment
      $isAdd = false;
      foreach ($carts as $key => $cart) {
        if($cart['bookid'] == $item['bookid'])
        {
          $carts[$key]['quantity'] = $carts[$key]['quantity'] + 1;
          $isAdd = true;
        }
      }

      if(!$isAdd)
      {
        array_push($carts,$item);
      }

      $request->session()->put('carts', $carts);
      return view('frontend.cart');
    }

    /**
     * Display view show user's cart.
     * @param  Request $request [description]
     * @return Illuminate\Http\Response
     */
    public function getCart(Request $request)
    {
      // $carts = $request->session()->get('carts', 'default');
      //
      // if( $carts == 'default' )
      // {
      //   $carts = array();
      // }
      //
      // $listItem = array();
      //
      // foreach ($carts as $key => $cart) {
      //   $book = Book::find($cart['bookid']);
      //   array_push($listItem, $book);
      // }
      //
      // $listItem = json_encode($listItem);
      return view('frontend.cart');
    }

    /**
     * Get ajax cart data.
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function ajax_getCart(Request $request)
    {
      $carts = $request->session()->get('carts', 'default');

      if($carts == 'default')
      {
        $carts = array();
      }

      $listItem = array();

      foreach ($carts as $cart) {
          $book = Book::find($cart['bookid']);
          $book->meta = $cart;
          $price = new Price;
          $book->price = $price->getPriceByBookId($book->id);
          array_push($listItem,$book);
      }

      $listItem = json_encode($listItem);
      return $listItem;
    }

    /**
     * [showPageCategory description]
     * @param  [type] $cateid [description]
     * @return [type]         [description]
     */
    public function showPageCategory($cateid)
    {
        $categories = Category::all();
        $languages = Language::all();
        $category = Category::find($cateid);
        $books = DB::table('books')->join('book_category','book_category.book_id','=','books.id')->where('category_id',$cateid)->paginate(8);
        return view('frontend.category', compact('books','categories','languages','category'));
    }

    /**
     * [searchCateAndLang description]
     * @param  [type] $cateid [description]
     * @param  [type] $langid [description]
     * @return [type]         [description]
     */
    public function searchCateAndLang($cateid,$langid)
    {
        $categories = Category::all();
        $languages = Language::all();
        $category = null;
        $book = null;
        $language = null;
        if($cateid == 'all' && $langid == 'all')
        {
          $books = DB::table('books')->paginate(8);
        }
        elseif ($cateid != 'all' && $langid == 'all') {
           $category = Category::find($cateid);
           $books = DB::table('books')->join('book_category','book_category.book_id','=','books.id')->where('category_id',$cateid)->paginate(8);
        }
        elseif ($cateid == 'all' && $langid != 'all') {
           $language = Language::find($langid);
           $books = DB::table('books')->where('language_id',$langid)->paginate(8);
        }
        elseif ($cateid != 'all' && $langid != 'all') {
           $category = Category::find($cateid);
           $language = Language::find($langid);
           $books = DB::table('books')->join('book_category','book_category.book_id','=','books.id')->where('category_id',$cateid)->where('language_id',$langid)->paginate(8);
        }

        return view('frontend.category', compact('books','categories','languages','category'));
    }

    /**
     * show search page with press search
     * @param  [type] $keyword [description]
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

    /**
     * show checkout page
     * @return [type] [description]
     */
    public function showCheckout()
    {

      if(URL::previous() != route('getCart'))
      {
        return redirect()->route('getCart');
      }

      if(Auth::user() == null)
      {
        return redirect('auth/login');
      }
      return view('frontend.checkout');
    }

    /**
     * Receive data checkout information
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postShowCheckout(Request $request)
    {
      $validator = Validator::make($request->all(),[
          'phone' => 'required|digits_between:7,15',
      ]);

      if ($validator->fails())
      {
        return redirect()->route('checkout')->withErrors($validator,'checkout')->withInput();
      }

      $date = date('Y-m-d H:i:s');
      $bill = Bill::create([
        'user_id' => Auth::user()->id,
        'phone' => $request->input('phone'),
        'coupon_code' => $request->input('coupon_code'),
        'address_receive_good' => $request->input('address_receive_good'),
        'date_purchased' => $date
      ]);

      $carts = $request->session()->get('carts', 'default');
      if($carts == 'default')
      {
        $carts = array();
      }

      $item = array('bookid'=>$request->bookid ,'amount'=>$request->amountYouPay,'quantity'=>1);
      $listItem = array();
      foreach ($carts as $key => $value) {
        DB::table('carts')->insert([
          'book_id' => $value['bookid'],
          'count'  => $value['quantity'],
          'bill_id' => $bill->id,
          'unit_price' => $value['amount']
        ]);
      }

      return redirect()->route('checkoutcomplete');
    }

    public function checkoutComplete()
    {
      return view('frontend.checkoutcomplete');
    }

}
