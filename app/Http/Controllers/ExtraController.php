<?php
namespace App\Http\Controllers;

use App\User;
use App\Models\Book;
use App\Models\Filebook;
use App\Models\Price;
use App\Models\Package;
use App\Models\Extrafile;
use App\Models\Extra;
use App\Models\Resource;

use File;
use DB;
use Illuminate\Http\Request;

class ExtraController extends Controller
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
   * Extrafile model.
   *
   * @var Extrafile class
   */
  protected $extrafile;

  /**
   * __construct description
   * @param Book     $book     [description]
   * @param User     $user     [description]
   * @param Filebook $filebook [description]
   * @param Price    $price    [description]
   * @param Resource $resource [description]
   * @param Package  $package  [description]
   * @param Extra    $extra    [description]
   */
  public function __construct(Book $book, User $user, Filebook $filebook, Price $price,
                                Resource $resource, Package $package, Extra $extra, Extrafile $extrafile)
  {
      $this->book = $book;
      $this->user = $user;
      $this->filebook = $filebook;
      $this->price = $price;
      $this->resource = $resource;
      $this->package = $package;
      $this->extrafile = $extrafile;
      $this->extra = $extra;
  }

  /**
   * [extras description]
   * @param  [type] $book_id [description]
   * @return [type]          [description]
   */
  public function extras($book_id)
  {
    $linkfilecss = 'extra.css';
    $book = $this->book->find($book_id);
    $listPackage = $this->package->all();
    $packages = array();
    foreach ($listPackage as $key => $value) {
      $packages += array($value->id => $value->name);
    }
    return view('frontend.extra.extras',compact('linkfilecss','book','packages'));
  }

  /**
   * Create extra for book.
   * @param  [int] $book_id [description]
   * @return [type]          [description]
   */
  public function addExtras($bookId, Request $request)
  {
      $name = $request->input('name');
      $description = $request->input('description');
      $packageId = $request->input('packages');
      $extra = $this->extra->create([
          'name' => $name,
          'description' => $description,
          'package_id' => $packageId,
      ]);
      $this->extrafile->attachFileIsUploadToExtra($extra->id, $bookId);
      return redirect()->route('extras', $bookId);
  }

  /**
   * [ajax_getFileExtra description]
   * @param  [type] $book_id [description]
   * @return [type]          [description]
   */
  public function ajax_getFileExtra($book_id)
  {
    $fileIsUploaded = $this->extrafile->getFileIsUploaded($book_id);
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
   * Upload extra file.
   * @param  [int]                $book_id
   * @param  IlluminateHttpRequest $request [description]
   * @return [type]                         [description]
   */
  public function uploadFileExtra($book_id, Request $request)
  {
    $file = $request->file('file');
    $namefileinital = $file->getClientOriginalName();
    $namefilesave = $this->generateRandomString();
    $extension = pathinfo($namefileinital)['extension'];

    $dirFile  = public_path() . DIRECTORY_SEPARATOR . 'resourcebook' . DIRECTORY_SEPARATOR;
    $filename = $namefilesave . '.' . $extension;
    $request->file('file')->move($dirFile, $filename);

    $this->extrafile->create([
      'name' => $namefileinital,
      'link' => $filename,
      'extra_id' => $book_id,
      'is_attached' => 0,
    ]);
  }

  /**
   * Delete file extra,
   * @param  [int] $book_id
   * @param  \Illuminate\Http\Request $request [description]
   * @return [type]                         [description]
   */
  public function deleteFileExtra($book_id, Request $request)
  {
    $filename = $request->input('filename');
    $identityFile = $this->getIdentityByName($filename);
    $dirFile = public_path() . DIRECTORY_SEPARATOR . 'resourcebook' . DIRECTORY_SEPARATOR . $identityFile;

    if(File::exists($dirFile))
    {
      File::delete($dirFile);
    }

    $this->deleteFileInCreateExtra($book_id, $filename);
  }

  /**
   * [editExtra description]
   * @param  [type] $book_id  [description]
   * @param  [type] $extra_id [description]
   * @return [type]           [description]
   */
  public function editExtra($book_id, $extra_id)
  {
    $extra = $this->extra->find($extra_id);
    $book = $this->book->find($book_id);

    $linkfilecss = 'extra.css';
    $t_packages = $this->package->all();
    $packages = array();

    foreach ($t_packages as $key => $value) {
      $packages += array($value->id => $value->name);
    }
    return view('frontend.extra.edit_extra',compact('extra','book','packages','linkfilecss'));
  }

  /**
   * [updateExtra description]
   * @param  [type]                $book_id  [description]
   * @param  [type]                $extra_id [description]
   * @param  IlluminateHttpRequest $request  [description]
   * @return [type]                          [description]
   */
  public function updateExtra($book_id, $extra_id, Request $request)
  {
    $name = $request->input('name');
    $description = $request->input('description');
    $package_id = $request->input('packages');

    $extra = $this->extrafile->find($extra_id)->update([
        'name' => $name,
        'description' => $description,
        'package_id' => $package_id,
    ]);

    return redirect()->route('edit_extra',array('id'=>$book_id, 'extra_id'=>$extra_id));
  }

  /**
   * Edit upload file extra.
   * @param  [type]                $book_id  [description]
   * @param  [type]                $extra_id [description]
   * @param  IlluminateHttpRequest $request  [description]
   * @return [type]                          [description]
   */
  public function editUploadFileExtra($book_id, $extra_id, Request $request)
  {
    $file = $request->file('file');
    $namefileinital = $file->getClientOriginalName();
    $namefilesave = generateRandomString();

    $extension = pathinfo($namefileinital)['extension'];

    $dirFile  = public_path() . DIRECTORY_SEPARATOR . 'resourcebook' . DIRECTORY_SEPARATOR;
    $filename = $namefilesave.'.'.$extension;
    $request->file('file')->move($dirFile,$filename);

    $this->extrafile->create([
      'name' => $namefileinital,
      'link' => $filename,
      'extra_id' => $extra_id,
      'is_attached' => 1,
    ]);
  }

  /**
   * Get request ajax extra file.
   * @param  [int] $book_id  [description]
   * @param  [int] $extra_id [description]
   * @return [type]           [description]
   */
  public function editGetFileExtra($book_id,$extra_id)
  {
    $fileIsUploaded = $this->extrafile->getFileIsUploadedToExtra($extra_id);
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
   * Delete in edit file extra.
   * @param  [type]                $book_id  [description]
   * @param  [type]                $extra_id [description]
   * @param  IlluminateHttpRequest $request  [description]
   * @return [type]                          [description]
   */
  public function editDeleteFileExtra($book_id, $extra_id, Request $request)
  {
    $filename = $request->input('filename');
    $identityFile = $this->extrafile->getIdentityByNameAndExtra($filename,$extra_id);
    $dirFile = public_path() . DIRECTORY_SEPARATOR . 'resourcebook' . DIRECTORY_SEPARATOR . $identityFile;

    if(File::exists($dirFile))
    {
      File::delete($dirFile);
    }

    $this->extrafile->deleteFileInEditExtra($extra_id, $filename);
  }

  /**
   * Delete extra in package.
   * @param  [int] $book_id    [description]
   * @param  [int] $package_id [description]
   * @param  [int] $extra_id   [description]
   * @return [type]             [description]
   */
  public function deleteExtraInPackage($book_id, $package_id, $extra_id)
  {
    $this->extra->find($extra_id)->delete();
    $this->extra->where('extra_id', $extra_id)->where('is_attached', 1)->delete();
    return redirect()->route('edit_extra',array('id'=>$book_id, 'extra_id'=>$extra_id));
  }
}
