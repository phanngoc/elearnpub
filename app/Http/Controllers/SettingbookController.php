<?php
namespace App\Http\Controllers;

use App\User;
use App\Models\Book;
use Request;
use App\Models\Price;
use App\Models\Package;
use DB;
use App\Models\Extrafile;
use File;
use App\Models\Extra;

class SettingbookController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($book_id)
    {
        $book = Book::find($book_id);
        $linkfilecss = 'generalsetting.css';
        return view('frontend.generalsetting',compact('book'));
    }

    /**
     * Receive Post data and save general setting book
     * @param integer $book_id  id of book
     */
    public function saveSettingbook($book_id)
    {

    }

    /**
     * Show page publish book
     * @param [[Type]] $book_id [[Description]]
     * @return [[Type]] [[Description]]
     */
    public function publish_book($book_id)
    {
        $book = Book::find($book_id);
        $linkfilecss = 'publish_book.css';
        return view('frontend.publishbook',compact('book'));
    }


    /**
     * Save setting publish book
     * @param [[Type]] $book_id [[Description]]
     * @return integer [[Description]]
     */
    public function post_publish_book($book_id)
    {

    }

    /**
     * [[Description]]
     * @param [[Type]] $book_id [[Description]]
     */
    public function publish_sample_book($book_id)
    {
        $book = Book::find($book_id);
        $linkfilecss = 'uploadtitlebook.css';
        return view('frontend.publishsamplebook',compact('book','linkfilecss'));
    }

    /**
     * [[Description]]
     * @param [[Type]] $book_id [[Description]]
     */
    public function post_publish_sample_book($book_id)
    {
        $book = Book::find($book_id);
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
        $book = Book::find($book_id);
        $linkfilecss = 'uploadtitlebook.css';
        return view('frontend.uploadtitlebook',compact('book','linkfilecss'));
    }

    /**
     * [generateRandomString description]
     * @param  integer $length [description]
     * @return [type]          [description]
     */
    public function generateRandomString($length = 10) {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
    }

    /**
     * [post_upload_new_title description]
     * @param  [type] $book_id [description]
     * @return [type]          [description]
     */
    public function post_upload_new_title($book_id)
    {
        $file = Request::file('avatar');
        $namefileinital = $file->getClientOriginalName();
        $namefilesave = $this->generateRandomString();

        $extension = pathinfo($namefileinital)['extension'];
        $dirFile  = public_path().DIRECTORY_SEPARATOR.'resourcebook'.DIRECTORY_SEPARATOR;
        $filename = $namefilesave.'.'.$extension;
        Request::file('avatar')->move($dirFile,$filename);

        $book = Book::find($book_id);
        $book->avatar = $namefileinital;
        $book->diravatar = $filename;
        $book->save();
        return redirect()->route('upload_new_title',$book_id);
    }

    /**
     * [pricing description]
     * @param  [type] $book_id [description]
     * @return [type]          [description]
     */
    public function pricing($book_id)
    {
        $book = Book::find($book_id);
        $linkfilecss = 'pricing.css';
        $price = new Price;
        $book->price = $price->getPriceByBookId($book_id);
        return view('frontend.pricing',compact('book','linkfilecss'));
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
      $book = Book::find($book_id);
      return view('frontend.package.package',compact('linkfilecss','book'));
    }

    /**
     * [post_package description]
     * @param  [type] $book_id [description]
     * @return [type]          [description]
     */
    public function post_package($book_id,\Illuminate\Http\Request $request)
    {
        $packages = Package::create($request->all());
        return redirect()->route('package',$book_id);
    }

    public function editPackage($book_id,$pack_id)
    {
      $linkfilecss = 'package.css';
      $book = Book::find($book_id);
      $package = Package::find($pack_id);
      $extras = Extra::getExtraByPackageId($pack_id);
      return view('frontend.package.edit_package',compact('book','package','linkfilecss','extras'));
    }
    /**
     * [extras description]
     * @param  [type] $book_id [description]
     * @return [type]          [description]
     */
    public function extras($book_id)
    {
      $linkfilecss = 'extra.css';
      $book = Book::find($book_id);
      $t_packages = Package::all();
      $packages = array();
      foreach ($t_packages as $key => $value) {
        $packages += array($value->id => $value->name);
      }
      return view('frontend.extras',compact('linkfilecss','book','packages'));
    }

    /**
     * [post_extras description]
     * @param  [type] $book_id [description]
     * @return [type]          [description]
     */
    public function addExtras($book_id,\Illuminate\Http\Request $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');
        $package_id = $request->input('packages');
        $extra = Extra::create([
            'name' => $name,
            'description' => $description,
            'package_id' => $package_id,
        ]);
        Extrafile::attachFileIsUploadToExtra($extra->id,$book_id);
        return redirect()->route('extras',$book_id);
    }

    /**
     * [ajax_getFileExtra description]
     * @param  [type] $book_id [description]
     * @return [type]          [description]
     */
    public function ajax_getFileExtra($book_id)
    {
      $fileIsUploaded = Extrafile::getFileIsUploaded($book_id);
      $result = array();
      foreach ($fileIsUploaded as $key => $value) {
        $item = array();
        $item['name'] = $value->name;
        $item['size'] = 100;
        $result[] = $item;
      }
      echo json_encode($result);
    }

    /**
     * [uploadFileExtra description]
     * @param  [type]                $book_id [description]
     * @param  IlluminateHttpRequest $request [description]
     * @return [type]                         [description]
     */
    public function uploadFileExtra($book_id,\Illuminate\Http\Request $request)
    {
      $file = $request->file('file');
      $namefileinital = $file->getClientOriginalName();
      $namefilesave = $this->generateRandomString();

      $extension = pathinfo($namefileinital)['extension'];

      $dirFile  = public_path().DIRECTORY_SEPARATOR.'resourcebook'.DIRECTORY_SEPARATOR;
      $filename = $namefilesave.'.'.$extension;
      $request->file('file')->move($dirFile,$filename);
      Extrafile::create([
        'name' => $namefileinital,
        'link' => $filename,
        'extra_id' => $book_id,
        'is_attached' => 0,
      ]);
      dd($request->file('file'));
    }

    /**
     * [deleteFileExtra description]
     * @param  [type]                $book_id [description]
     * @param  IlluminateHttpRequest $request [description]
     * @return [type]                         [description]
     */
    public function deleteFileExtra($book_id,\Illuminate\Http\Request $request)
    {
      $filename = $request->input('filename');
      $identityFile = Extrafile::getIdentityByName($filename);
      $dirFile = public_path().DIRECTORY_SEPARATOR.'resourcebook'.DIRECTORY_SEPARATOR.$identityFile;
      if(File::exists($dirFile))
      {
        File::delete($dirFile);
      }
      Extrafile::deleteFileInCreateExtra($book_id,$filename);
    }
}
