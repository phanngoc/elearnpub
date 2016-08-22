<?php
namespace App\Http\Controllers;

use App\User;
use App\Models\Book;
use App\Models\Price;
use App\Models\Package;
use App\Models\Extrafile;
use App\Models\Extra;
use App\Http\Requests\SaveSettingBookRequest;

use DB;
use File;
use Illuminate\Http\Request;

class SettingbookController extends Controller
{
    /**
     * Book model.
     *
     * @var Book class
     */
    protected $book;

    /**
     * Package model.
     *
     * @var Package class
     */
    protected $package;

    /**
     * Extra model.
     *
     * @var Extra class
     */
    protected $extra;

    /**
     * Price model.
     *
     * @var Price class
     */
    protected $price;

    /**
     * __construct description
     * @param Book     $book     [description]
     * @param Package  $package  [description]
     * @param Extra    $extra    [description]
     */
    public function __construct(Book $book, Package $package, Extra $extra, Price $price)
    {
        $this->book = $book;
        $this->package = $package;
        $this->extra = $extra;
        $this->price = $price;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($book_id)
    {
        $book = $this->book->find($book_id);
        $linkfilecss = 'generalsetting.css';
        return view('frontend.generalsetting',compact('book', 'linkfilecss'));
    }

    /**
     * Receive Post data and save general setting book
     * @param integer $book_id  id of book
     */
    public function saveSettingbook(SaveSettingBookRequest $request, $bookId)
    {
      $this->book->find($bookId)->update($request->all());
      return redirect()->action('SettingbookController@index', $bookId);
    }

    /**
     * Show page publish book.
     * @param [int] $book_id [[Description]]
     * @return [[Type]] [[Description]]
     */
    public function publishBook($book_id)
    {
        $book = $this->book->find($book_id);
        $linkfilecss = 'publish_book.css';
        return view('frontend.publishbook',compact('book', 'linkfilecss'));
    }


    /**
     * Save setting publish book
     * @param [int] $book_id
     * @return integer
     */
    public function postPublishBook(Request $request, $bookId)
    {
      $book = $this->book->find($bookId);
      $book->update([
          'release_note' => $request->release_note,
          'is_published' => 1,
      ]);

      $linkfilecss = 'publish_book.css';
      return view('frontend.publishbook',compact('book', 'linkfilecss'));
    }

    /**
     *
     * @param [int] $book_id If of book.
     */
    public function publish_sample_book($book_id)
    {
        $book = $this->book->find($book_id);
        $linkfilecss = 'uploadtitlebook.css';
        return view('frontend.publishsamplebook', compact('book', 'linkfilecss'));
    }

    /**
     * Post publish sample book.
     * @param [int] $book_id
     */
    public function post_publish_sample_book($book_id)
    {
        $book = $this->book->find($book_id);
        $book->is_publish_sample = ($book->is_publish_sample == 0) ? 1 : 0;
        $book->save();
        return redirect()->route('publish_sample_book',$book_id);
    }

    /**
     * Upload avatar for book
     * @param  [[Type]] $book_id [[Description]]
     * @return [[Type]] [[Description]]
     */
    public function upload_new_title($book_id)
    {
        $book = $this->book->find($book_id);
        $linkfilecss = 'uploadtitlebook.css';
        return view('frontend.uploadtitlebook', compact('book', 'linkfilecss'));
    }

    /**
     * [post_upload_new_title description]
     * @param  [int] $book_id [description]
     * @return [type]          [description]
     */
    public function post_upload_new_title($book_id, Request $request)
    {
        $file = $request->file('avatar');
        $namefileinital = $file->getClientOriginalName();
        $namefilesave = generateRandomString();

        $extension = pathinfo($namefileinital)['extension'];
        $dirFile  = public_path() . DIRECTORY_SEPARATOR . 'resourcebook' . DIRECTORY_SEPARATOR;
        $filename = $namefilesave.'.'.$extension;
        $request->file('avatar')->move($dirFile, $filename);

        $book = $this->book->find($book_id);
        $book->avatar = $namefileinital;
        $book->diravatar = $filename;
        $book->save();

        return redirect()->route('upload_new_title', $book_id);
    }

    /**
     * [pricing description]
     * @param  [type] $book_id [description]
     * @return [type]          [description]
     */
    public function pricing($book_id)
    {
        $book = $this->book->find($book_id);
        $linkfilecss = 'pricing.css';
        $book->price = $this->price->getPriceByBookId($book_id);
        return view('frontend.pricing', compact('book', 'linkfilecss'));
    }

    /**
     * [post_pricing description]
     * @param  [type] $book_id [description]
     * @return [type]          [description]
     */
    public function post_pricing($book_id)
    {
      $key = 'bo|'.$book_id;
      DB::table('prices')->where('item_id',$key)->update(['minimumprice' => Request::input('minimumprice'),'suggestedprice' => Request::input('suggestedprice')]);
      return redirect()->route('pricing',$book_id);
    }

    /**
     * [package description]
     * @param  [type] $book_id [description]
     * @return [type]          [description]
     */
    public function package($book_id)
    {
      $linkfilecss = 'package.css';
      $book = $this->book->find($book_id);
      return view('frontend.package.package',compact('linkfilecss','book'));
    }

    /**
     * Post package description.
     * @param  [type] $book_id [description]
     * @return [type]          [description]
     */
    public function post_package($book_id, Request $request)
    {
        $packages = $this->package->create($request->all());
        return redirect()->route('package', $book_id);
    }

    /**
     * Edit package.
     * @param  [type] $book_id [description]
     * @param  [type] $pack_id [description]
     * @return [type]          [description]
     */
    public function editPackage($book_id, $pack_id)
    {
      $linkfilecss = 'package.css';
      $book = $this->book->find($book_id);
      $package = $this->package->find($pack_id);
      $extras = $this->extra->getExtraByPackageId($pack_id);
      return view('frontend.package.edit_package',compact('book','package','linkfilecss','extras'));
    }

    /**
     * Update package.
     * @param  [type]                $book_id    [description]
     * @param  [type]                $package_id [description]
     * @param  IlluminateHttpRequest $request    [description]
     * @return [type]                            [description]
     */
    public function updatePackage($book_id, $package_id, Request $request)
    {
      $this->package->find($package_id)->update($request->all());
      return redirect()->route('edit_package', array('id'=>$book_id, 'package_id'=>$package_id));
    }

    /**
     * List package.
     * @param  [type] $book_id [description]
     * @return [type]          [description]
     */
    public function listPackage($book_id)
    {
      $book = $this->book->find($book_id);
      $packages = $this->package->all();
      $linkfilecss = 'list_package.css';
      return view('frontend.package.list_package', compact('book','packages','linkfilecss'));
    }

    /**
     * Delete package.
     * @param  [type] $book_id    [description]
     * @param  [type] $package_id [description]
     * @return [type]             [description]
     */
    public function deletePackage($book_id, $package_id)
    {
      $this->package->deletePackage($package_id);
      return redirect()->route('list_package',$book_id);
    }
}
