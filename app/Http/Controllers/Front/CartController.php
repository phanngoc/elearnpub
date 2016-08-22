<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Validator;
use Zipper;
use Auth;
use DB;
use URL;
use Session;

use App\User;
use App\Models\Book;
use App\Models\Price;
use App\Models\Cart;
use App\Models\Bill;

class CartController extends Controller
{

  /**
   * Book model.
   *
   * @var Book class
   */
  protected $book;

  /**
   * Cart model.
   *
   * @var Cart class
   */
  protected $cart;

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
   * Bill model.
   *
   * @var Bill class
   */
  protected $bill;


  /**
   * Construct
   *
   * @param Book $book
   * @param User $user
   * @param FileBook $filebook
   */
  public function __construct(Book $book, User $user, Cart $cart, Price $price, Bill $bill)
  {
      $this->book = $book;
      $this->user = $user;
      $this->cart = $cart;
      $this->price = $price;
      $this->bill = $bill;
  }

  /**
   * Display view show user's cart.
   * @param  Request $request
   * @return Illuminate\Http\Response
   */
  public function getCart(Request $request)
  {
    return view('frontend.cart');
  }

  /**
   * Get ajax cart data.
   * @param  Request $request [description]
   * @return [type]           [description]
   */
  public function ajax_getCart(Request $request)
  {
    $carts = $request->session()->get('carts', 'default');

    if($carts == 'default')
    {
      $carts = array();
    }

    $listItem = array();

    foreach ($carts as $cart) {
        $book = $this->cart->findItem($cart['item_id'], $cart['type']);
        $book->meta = $cart;
        array_push($listItem, $book);
    }

    $listItem = json_encode($listItem);
    return $listItem;
  }

  /**
   * Post data from cart into session.
   * @param  Request $request
   * @return Illuminate\Http\Response
   */
  public function addItemToCart(Request $request)
  {
    $item = array('item_id' => $request->item_id, 'type' => $request->type,
                  'amount' => $request->amountYouPay, 'quantity' => 1);

    $this->addItemCartSession($item);

    return view('frontend.cart');
  }

  /**
   * Add item into cart session.
   * @param [array] $item [description]
   */
  private function addItemCartSession($item) {
    $carts = request()->session()->get('carts', 'default');

    if ($carts == 'default')
    {
      $carts = array();
    }

    $isAdd = false;

    foreach ($carts as $key => $cart) {
      if($cart['item_id'] == $item['item_id'] && $cart['type'] == $item['type'])
      {
        $carts[$key]['quantity'] = $item['quantity'];
        $carts[$key]['amount'] = $item['amount'];
        $isAdd = true;
      }
    }

    if (!$isAdd)
    {
      array_push($carts, $item);
    }

    request()->session()->put('carts', $carts);
  }

  /**
   * Ajax update cart.
   * @param  Request $request
   * @return Illuminate\Http\Response
   */
  public function updateCart(Request $request)
  {
    $data = $request->data;
    $carts = array_pluck($data, 'meta');
    foreach ($carts as $cart) {
      $this->addItemCartSession($cart);
    }
  }

  /**
   * Show checkout page
   * @return [type] [description]
   */
  public function showCheckout()
  {
    if(URL::previous() != route('getCart'))
    {
      return redirect()->route('getCart');
    }

    if(Auth::user() == null)
    {
      return redirect('auth/login');
    }
    return view('frontend.checkout');
  }

  /**
   * Receive data checkout information
   * @param  Request $request [description]
   * @return [type]           [description]
   */
  public function postShowCheckout(Request $request)
  {
    $validator = Validator::make($request->all(),[
        'phone' => 'required|digits_between:7,15',
    ]);

    if ($validator->fails())
    {
      return redirect()->route('checkout')->withErrors($validator, 'checkout')->withInput();
    }

    $date = date('Y-m-d H:i:s');

    $bill = $this->bill->create([
      'user_id' => Auth::user()->id,
      'phone' => $request->input('phone'),
      'coupon_code' => $request->input('coupon_code'),
      'address_receive_good' => $request->input('address_receive_good'),
      'date_purchased' => $date
    ]);

    $carts = $request->session()->get('carts', 'default');

    if ($carts == 'default')
    {
      $carts = array();
    }

    foreach ($carts as $cart) {
      $this->cart->create([
        'type' => $cart['type'],
        'item_id' => $cart['item_id'],
        'count'  => $cart['quantity'],
        'bill_id' => $bill->id,
        'unit_price' => $cart['amount']
      ]);
    }

    return redirect()->route('checkoutcomplete');
  }

  /**
   * Show page checkout.
   * @return [type] [description]
   */
  public function checkoutComplete()
  {
    return view('frontend.checkoutcomplete');
  }

}
