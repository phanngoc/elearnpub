<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Book;
use App\Models\Resource;
use App\Models\Price;

class HomeController extends Controller
{

    public function index()
    {
       $carts = Cart::all();	
       $arrIdBooks = array();
       foreach ($carts as $k_ca => $v_ca) {
       	  if (!array_key_exists($v_ca->id,$arrIdBooks))
       	  {
       	  	$arrIdBooks += array($v_ca->id => $v_ca->count);
       	  }
       	  else
       	  {
       	  	$arrIdBooks[$v_ca->id] += $v_ca->count;
       	  }

       }
  	   arsort($arrIdBooks);
  	   $books = array();
  	   foreach ($arrIdBooks as $k_ar => $v_ar) {
          $currentBook = Book::find($k_ar);
          $currentBook['meta'] = Book::getMainAuthor($currentBook->id);
  	      array_push($books,$currentBook);
  	   }

       $bookfeature = Book::orderBy('publisted_at')->get();
       foreach ($bookfeature as $k_b => $v_b) {
          $bookfeature[$k_b]['meta'] = Book::getMainAuthor($v_b->id);
       }
       

       return view('frontend.home',compact('books','bookfeature')); 
    }

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
    
}
