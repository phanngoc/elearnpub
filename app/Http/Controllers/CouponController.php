<?php
namespace App\Http\Controllers;

use App\Repositories\CouponRepository;
use App\Http\Requests\CreateCouponRequest;

class CouponController extends Controller
{

  /**
   * Coupon repository model.
   * @var CouponRepository class
   */
  protected $couponRepository;

  /**
   * Construct
   *
   * @param Book $book
   * @param User $user
   * @param FileBook $filebook
   */
  public function __construct(CouponRepository $couponRepository)
  {
      $this->couponRepository = $couponRepository;
  }


  /**
   * List all coupons.
   * @return [type] [description]
   */
  public function coupons($bookId) {
    $coupons = $this->couponRepository->findByField('book_id', $bookId);
    return view('frontend.coupon.list_coupon', compact('coupons'));
  }

  /**
   * Show page add coupon.
   * @param [int] $bookId [description]
   */
  public function createCoupon($bookId)
  {
    return view('frontend.coupon.add_coupon');
  }

  /**
   * Store coupon.
   * @param  [type]              $bookId  [description]
   * @param  CreateCouponRequest $request [description]
   * @return [type]                       [description]
   */
  public function storeCoupon($bookId, CreateCouponRequest $request) {
    $input = $request->all();
    $input['book_id'] = $bookId;
    $this->couponRepository->create($request->all());
    return redirect()->route('list_coupon', $bookId);
  }

  /**
   * Show page edit coupon.
   * @param [int] $bookId [description]
   */
  public function editCoupon($bookId, $couponId)
  {
    $coupon = $this->couponRepository->find($couponId);
    return view('frontend.coupon.edit_coupon', compact('coupon'));
  }

  /**
   * Post update coupon.
   * @param [int] $bookId [description]
   */
  public function updateCoupon($bookId, $couponId, CreateCouponRequest $request)
  {
    $coupon = $this->couponRepository->update($request->all(), $couponId);
    return redirect()->route('list_coupon', $bookId);
  }

  /**
   * Post delete coupon.
   * @param [int] $bookId [description]
   */
  public function deleteCoupon($bookId, $couponId)
  {
    $coupon = $this->couponRepository->delete($couponId);
    return redirect()->route('list_coupon', $bookId);
  }
}
