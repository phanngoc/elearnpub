<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Book;
use App\Models\Resource;
use App\Models\Price;
use App\Models\Filebook;
use Markdown;
use Illuminate\Http\Request;
use File;
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

    public function test()
    {
      echo Markdown::parse('# Chapter 1 Hello, world!');
    }

    public function write($id,$namefile='')
    {
      $currentBook = Book::find($id); 
      $files = Book::getFileFromBook($id);   
      $filebook = Book::getContentByName($namefile,$files[0]->name);
      return view('frontend.writebook',compact('files','filebook'));
    }

    /**
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
     * @param  Request
     * @return [type]
     */
    public function ajax_removefile(Request $request)
    {
      $filebook = Filebook::find($request->id);
      $dirFile  = base_path().DIRECTORY_SEPARATOR.'book'.DIRECTORY_SEPARATOR.$filebook->book_id.DIRECTORY_SEPARATOR.$filebook->link;
      if(File::exists($dirFile))
      {
        File::delete($dirFile);
      }
      $filebook->delete();
    }

    /**
     * @param  Request
     * @return [type]
     */
    public function ajax_newfile(Request $request,$id)
    {
      $namenewfile = $request->namenewfile;
      
      if(!File::exists( base_path().DIRECTORY_SEPARATOR.'book'.DIRECTORY_SEPARATOR.$id)) {
        // dd(base_path().DIRECTORY_SEPARATOR.'book'.DIRECTORY_SEPARATOR.$id);
        File::makeDirectory( base_path().DIRECTORY_SEPARATOR.'book'.DIRECTORY_SEPARATOR.$id);
      }
      if (pathinfo($namenewfile, PATHINFO_EXTENSION) == '')
      {
        $namenewfile .= '.txt';
      }
      $file = base_path().DIRECTORY_SEPARATOR.'book'.DIRECTORY_SEPARATOR.$id.DIRECTORY_SEPARATOR.$namenewfile;
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
     * [ajax_autoSaveContentFile description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function ajax_autoSaveContentFile(Request $request)
    {
      $filebook = Filebook::find($request->file_id);
      $filebook->content = $request->content;
      $filebook->save();
    }
}
