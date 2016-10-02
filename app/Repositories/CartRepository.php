<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Cart;
use DB;

class CartRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
      return Cart::class;
    }

    /**
     * List cart belong bill.
     * @return [type] [description]
     */
    public function listCartBelongBill($billId) {
      $booksCart = DB::table('carts')->join('books', 'books.id', '=', 'carts.item_id')
                        ->where('item_id', Cart::TYPE_BOOK)
                        ->where('bill_id', $billId)
                        ->whereNull('carts.deleted_at')
                        ->whereNull('books.deleted_at')
                        ->select(['title', 'item_id', 'type', 'count', 'unit_price']);
      $bundlesCart = DB::table('carts')->join('bundles', 'bundles.id', '=', 'carts.item_id')
                        ->where('item_id', Cart::TYPE_BUNDLE)
                        ->where('bill_id', $billId)
                        ->whereNull('carts.deleted_at')
                        ->whereNull('bundles.deleted_at')
                        ->select(['title', 'item_id', 'type', 'count', 'unit_price'])
                        ->union($booksCart)
                        ->get();
      return $bundlesCart;
    }

    
}
