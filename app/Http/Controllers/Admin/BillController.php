<?php
namespace App\Http\Controllers\Admin;

use \Illuminate\Http\Request;
use DB;
use File;
use Validator;
use App\Http\Controllers\Controller;
use App\Repositories\BillRepository;
use App\Repositories\CartRepository;

class BillController extends AdminController
{
  private $billRepository;

  private $cartRepository;

  function __construct(BillRepository $billRepository, CartRepository $cartRepository) {
    $this->billRepository = $billRepository;
    $this->cartRepository = $cartRepository;
  }

  /**
   * Return list book.
   * @return [type] [description]
   */
  public function listBills() {
    $pagiListBills = $this->billRepository->listBills();

    $results = array(
      'items' => $pagiListBills->items(),
      'currentPage' => $pagiListBills->currentPage(),
      'total' => $pagiListBills->total()
    );

    return $this->responseSuccess(200, $results);
  }

  /**
   * List cart beblong bill.
   * @param  [type] $billId [description]
   * @return [type]         [description]
   */
  public function listCartInBill($billId) {
    $results = $this->cartRepository->listCartBelongBill($billId);
    return $this->responseSuccess(200, $results);
  }

  /**
   * Get data chart for month.
   * @return [type] [description]
   */
  public function billChartMonth(Request $request) {
    $params = ['start_month' => $request->input('start_month'),
                'end_month' => $request->input('end_month')];
    $results = $this->billRepository->billCharts($params);
    return $this->responseSuccess(200, $results);
  }

  /**
   * Get data chart for month.
   * @return [type] [description]
   */
  public function chartTopSell(Request $request) {

    $results = $this->billRepository->topSellItem($request->input('start'),
                                                  $request->input('end'),
                                                  $request->input('limit'));

    return $this->responseSuccess(200, $results);
  }
}
