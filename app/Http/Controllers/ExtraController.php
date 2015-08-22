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

class ExtraController extends Controller
{

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
    return view('frontend.extra.extras',compact('linkfilecss','book','packages'));
  }

  /**
   * [addExtras description]
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

  /**
   * [editExtra description]
   * @param  [type] $book_id  [description]
   * @param  [type] $extra_id [description]
   * @return [type]           [description]
   */
  public function editExtra($book_id,$extra_id)
  {
    $extra = Extra::find($extra_id);
    $book = Book::find($book_id);
    $linkfilecss = 'extra.css';
    $t_packages = Package::all();
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
  public function updateExtra($book_id,$extra_id,\Illuminate\Http\Request $request)
  {
    $name = $request->input('name');
    $description = $request->input('description');
    $package_id = $request->input('packages');
    $extra = Extra::find($extra_id)->update([
        'name' => $name,
        'description' => $description,
        'package_id' => $package_id,
    ]);
    return redirect()->route('edit_extra',array('id'=>$book_id,'extra_id'=>$extra_id));
  }

  /**
   * [editUploadFileExtra description]
   * @param  [type]                $book_id  [description]
   * @param  [type]                $extra_id [description]
   * @param  IlluminateHttpRequest $request  [description]
   * @return [type]                          [description]
   */
  public function editUploadFileExtra($book_id,$extra_id,\Illuminate\Http\Request $request)
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
      'extra_id' => $extra_id,
      'is_attached' => 1,
    ]);
    dd($request->file('file'));
  }

  /**
   * [editGetFileExtra description]
   * @param  [type] $book_id  [description]
   * @param  [type] $extra_id [description]
   * @return [type]           [description]
   */
  public function editGetFileExtra($book_id,$extra_id)
  {
    $fileIsUploaded = Extrafile::getFileIsUploadedToExtra($extra_id);
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
   * [editDeleteFileExtra description]
   * @param  [type]                $book_id  [description]
   * @param  [type]                $extra_id [description]
   * @param  IlluminateHttpRequest $request  [description]
   * @return [type]                          [description]
   */
  public function editDeleteFileExtra($book_id,$extra_id,\Illuminate\Http\Request $request)
  {
    $filename = $request->input('filename');
    $identityFile = Extrafile::getIdentityByNameAndExtra($filename,$extra_id);
    $dirFile = public_path().DIRECTORY_SEPARATOR.'resourcebook'.DIRECTORY_SEPARATOR.$identityFile;
    if(File::exists($dirFile))
    {
      File::delete($dirFile);
    }
    Extrafile::deleteFileInEditExtra($extra_id,$filename);
  }

  public function deleteExtraInPackage($book_id,$package_id,$extra_id)
  {
    Extra::find($extra_id)->delete();
    Extrafile::where('extra_id',$extra_id)->where('is_attached',1)->delete();
    return redirect()->route('edit_extra',array('id'=>$book_id,'extra_id'=>$extra_id));
  }
}
