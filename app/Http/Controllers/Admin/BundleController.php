<?php
namespace App\Http\Controllers\Admin;

use \Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\BundleRepository;

class BundleController extends AdminController
{

  private $bundleRepository;

  function __construct(BundleRepository $bundleRepository) {
    $this->bundleRepository = $bundleRepository;
  }

  /**
   * Return list book.
   * @return [type] [description]
   */
  public function find($bundleId) {
    $results = $this->bundleRepository->with(['books'])->find($bundleId);
    return $this->responseSuccess(200, $results);
  }

  /**
   * Update bundle.
   * @return [type] [description]
   */
  public function update($bundleId, Request $request) {
    $results = $this->bundleRepository->update($request->all(), $bundleId);
    return $this->responseSuccess(200, $results);
  }

}
