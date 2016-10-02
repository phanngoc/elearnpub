<?php
namespace App\Http\Controllers;

use App\User;
use App\Models\Book;
use App\Models\Price;
use App\Models\Package;
use App\Models\Extrafile;
use App\Models\Extra;
use App\Http\Requests\SaveSettingBookRequest;
use App\Repositories\BookRepository;
use App\Repositories\PackageRepository;
use App\Repositories\PriceRepository;

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
     * Book repository.
     *
     * @var BookRepository class
     */
    protected $bookRepository;

    /**
     * Package repository.
     *
     * @var PackageRepository class
     */
    protected $packageRepository;

    /**
     * Price repository.
     *
     * @var PriceRepository class
     */
    protected $priceRepository;

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
    public function __construct(Book $book, BookRepository $bookRepository,
                                PackageRepository $packageRepository,
                                Package $package, Extra $extra, Price $price,
                                PriceRepository $priceRepository)
    {
        $this->book = $book;
        $this->bookRepository = $bookRepository;
        $this->packageRepository = $packageRepository;
        $this->priceRepository = $priceRepository;
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
    public function publishBook($bookId)
    {
        return view('frontend.publishbook');
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

      return view('frontend.publishbook');
    }

    /**
     * Show page allow user publish sample book.
     * @param [int] $book_id If of book.
     */
    public function publishSampleBook($bookId)
    {
        return view('frontend.publishsamplebook');
    }

    /**
     * Post publish sample book.
     * @param [int] $book_id
     */
    public function postPublishSampleBook($book_id)
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
    public function uploadNewTitle($bookId)
    {
        return view('frontend.uploadtitlebook');
    }

    /**
     * [post_upload_new_title description]
     * @param  [int] $book_id [description]
     * @return [type]          [description]
     */
    public function postUploadNewTitle($book_id, Request $request)
    {
        $file = $request->file('avatar');
        $namefileinital = $file->getClientOriginalName();
        $namefilesave = generateRandomString();

        $extension = pathinfo($namefileinital)['extension'];
        $dirFile  = config('common.url_upload');
        $filename = $namefilesave.'.'.$extension;
        $request->file('avatar')->move($dirFile, $filename);

        $book = $this->book->find($book_id);
        $book->avatar = $namefileinital;
        $book->diravatar = $filename;
        $book->save();

        return redirect()->route('upload_new_title', $book_id);
    }

    /**
     * Page update price.
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
    public function post_pricing($bookId, Request $request)
    {
      $params = $request->all();
      unset($params['_token']);
      $this->priceRepository->updatePriceBook($bookId, $params);
      return redirect()->route('pricing', $bookId);
    }

    /**
     * Page show package of book.
     * @param  [type] $book_id [description]
     * @return [type]          [description]
     */
    public function package($book_id)
    {
      return view('frontend.package.package');
    }

    /**
     * Post package description.
     * @param  [type] $book_id [description]
     * @return [type]          [description]
     */
    public function postPackage($book_id, Request $request)
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
    public function editPackage($bookId, $packageId)
    {
      $book = $this->bookRepository->find($bookId);
      $package = $this->packageRepository->getPackageWithExtras($packageId);
      return view('frontend.package.edit_package',compact('book', 'package'));
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
      return redirect()->route('edit_package', array('id' => $book_id,
                                                      'package_id' => $package_id));
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
      return view('frontend.package.list_package', compact('book','packages'));
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
