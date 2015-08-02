<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Book;


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
       //dd($books);
       return view('frontend.home',compact('books')); 
    }

    
}
