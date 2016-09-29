<?php
namespace App\Http\Controllers\Admin;

use \Illuminate\Http\Request;
use DB;
use File;
use Validator;
use Response;

use App\User;
use App\Models\Book;
use App\Models\Price;
use App\Models\Package;
use App\Models\Extrafile;
use App\Models\Extra;
use App\Models\Category;
use App\Models\Language;
use App\Models\Filebook;
use App\Models\Resource;

use App\Http\Controllers\Controller;

class AdminController extends Controller
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
  public function __construct(Book $book, FileBook $filebook, User $user, Price $price, Resource $resource)
  {
      $this->book = $book;
      $this->user = $user;
      $this->filebook = $filebook;
      $this->price = $price;
      $this->resource = $resource;
  }

  /**
   * Load main page admin.
   * @return [type] [description]
   */
  public function homeAdmin() {
    return view("admin.home");
  }

  /**
   * Response structure json success.
   *
   * @param int   $statusCode Status code 2xx : 200, 201
   * @param array $data       Data return
   *
   * @return Illuminate\Http\Response response data json
   */
  public function responseSuccess($statusCode, $data)
  {
      $jsonOut = [
          'status' => true,
          'result' => $data,
      ];

      return response()->json($jsonOut, $statusCode);
  }

  /**
   * Response structure json error.
   *
   * @param int    $statusCode Status code 4xx : 400, 401,..
   * @param string $message    Message return to user
   * @param string $errors     Error
   *
   * @return Illuminate\Http\Response response data json
   */
  public function responseError($statusCode = Response::HTTP_NOT_FOUND, $message = '', $errors = null)
  {
      $jsonOut = [
          'status' => false,
          'result' => [
              'message' => $message,
              'errors' => $errors,
          ],
      ];
      return response()->json($jsonOut, $statusCode);
  }
  
  /**
   * Json response with pagination
   *
   * @param Collection $items          items for response
   * @param string     $collectionName name of root response object
   * @param int        $total          total item
   * @param int        $perPage        item per page
   * @param booleam    $hasNextPage    has next page
   * @param array      $param          param
   *
   * @return response
   */
  public function responsePaginate($items, $collectionName, $total = 0, $perPage = 0, $hasNextPage = false, $param = [])
  {
      $data = [
              'total' => $total,
              'per_page' => $perPage,
              'has_next_page' => $hasNextPage,
              $collectionName => $items,
          ];
      return $this->responseSuccess(Response::HTTP_OK, array_merge($param, $data));
  }

  /**
   * General upload files.
   * @param  Request $request [description]
   * @return [type]           [description]
   */
  public function uploads(Request $request) {

    $files = $request->file('files');
    $newNames = $request->input('newNames');
    $destinationPath = public_path().'/uploads/';

    if ($files) {
      foreach (glob($destinationPath . "temp_*") as $temp) {
          File::delete($temp);
      }

      foreach ($files as $key => $file) {
        $file->move($destinationPath, $newNames[$key]);
      }
    }

    return $this->responseSuccess(200, $newNames);
  }
}
