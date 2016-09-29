<?php
namespace App\Http\Controllers\Admin;

use \Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PackageRepository;

class PackageController extends AdminController
{

  private $packageRepository;

  function __construct(PackageRepository $packageRepository) {
    $this->packageRepository = $packageRepository;
  }

  /**
   * Return list book.
   * @return [type] [description]
   */
  public function find($packageId) {
    $results = $this->packageRepository->with(['book'])->find($packageId);
    return $this->responseSuccess(200, $results);
  }

  /**
   * Update package.
   * @return [type] [description]
   */
  public function update($packageId, Request $request) {
    $results = $this->packageRepository->update($request->all(), $packageId);
    return $this->responseSuccess(200, $results);
  }

}
