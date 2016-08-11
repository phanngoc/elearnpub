<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Models\Book;
use App\Models\Resource;
use App\Models\Filebook;
use App\Models\Price;
use Validator;
use Auth;

class BookController extends Controller
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
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $bookpublish = $this->book->getBookPublished();
        $bookunpublish = $this->book->getBookUnPublished();
        return view('frontend.book', compact('bookpublish','bookunpublish'));
    }

    /**
     * Show book detail page
     * @param  [type] $param [description]
     * @return [type]        [description]
     */
    public function book($param)
    {
      $book = $this->book->where('bookurl', $param)->first();
      $book->meta = $this->book->getMainAuthor($book->id);
      $book->price = $this->price->getPriceByBookId($book->id);
      $sample = $this->resource->getSampleByBook($book->id);

      return view('frontend.detailbook', compact('book', 'sample'));
    }

    /**
     * Create view create book.
     * @return [type] [description]
     */
    public function newBook()
    {
        return view('frontend.book.new_book');
    }

    /**
     * Post request to create new book.
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postNewBook(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'bookurl' => 'required',
        ]);

        if($validator->fails())
        {
          return redirect()->route('new_book')->withErrors($validator, 'newbook')->withInput();
        }

        $book = $this->book->addNewBook($request->all());
        return redirect()->route('settingbook', $book->id);
    }

    /**
     * Add book to user wishlist.
     * @param [int] $id [description]
     */
    public function add_wishlist($id)
    {
        $this->user->addBookToWishlist($id);
        return redirect('wishlist');
    }

    /**
     * Remove book from wishlist.
     * @param  [int] $id Book id
     * @return [type]     [description]
     */
    public function delete_wishlist($bookId)
    {
        $this->user->removeBookFromWishlist($bookId);
        return redirect('wishlist');
    }

    /**
     * Page write book.
     * @param  [int] $bookId   If of book.
     * @param  string $namefile
     * @return [type]           [description]
     */
    public function write($bookId, $namefile='')
    {
      if (!$this->book->isBookBelongUser($bookId, Auth::user()->id))
      {
        return redirect()->route('book');
      }

      $currentBook = $this->book->find($bookId);
      $files = $this->book->getFileFromBook($bookId);
      $filebook = $this->book->getContentByName($namefile, $files[0]->name);
      return view('frontend.writebook', compact('files', 'filebook'));
    }

    /**
     * Rename name file in page write book.
     * @param  Request
     * @return [type]
     */
    public function ajax_renamefile(Request $request)
    {
      $filebook = $this->filebook->find($request->id);
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
      $filebook = $this->filebook->find($request->id);
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

      if (!File::exists(base_path() . DIRECTORY_SEPARATOR . 'book' . DIRECTORY_SEPARATOR . $id)) {
         File::makeDirectory(base_path() . DIRECTORY_SEPARATOR . 'book' . DIRECTORY_SEPARATOR . $id);
      }

      if (pathinfo($namenewfile, PATHINFO_EXTENSION) == '')
      {
         $namenewfile .= '.txt';
      }

      $file = base_path() . DIRECTORY_SEPARATOR . 'book' . DIRECTORY_SEPARATOR . $id . DIRECTORY_SEPARATOR . $namenewfile;
      File::put($file, '# New Chapter');

      $newbook = $this->filebook->create([
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
     * @return void
     */
    public function ajax_issample(Request $request)
    {
      $file_id = $request->file_id;
      $isSample = $request->isSample;
      $filebook = $this->filebook->find($file_id);
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
      $filebook = $this->filebook->find($request->file_id);
      $filebook->content = $request->content;
      $filebook->save();
    }

}
