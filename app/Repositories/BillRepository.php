<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Bill;
use App\Models\Cart;
use DB;

class BillRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
      return Bill::class;
    }

    /**
     * List bill and user.
     * @return [type] [description]
     */
    public function listBills() {
      return $this->model->with('user')->paginate(3);
    }

    /**
     * Bill charts in month.
     * @return [type] [description]
     */
    public function billCharts($params) {
      $startMonth = substr($params['start_month'], 0, 7);
      $endMonth = substr($params['end_month'], 0, 7);

      $results = DB::table('bills')->select([DB::raw('DATE_FORMAT(date_purchased, "%Y-%m") as date'), DB::raw('count(id) as num')])
                ->groupBy('date')
                ->havingRaw('date >= "' . $startMonth . '" AND date <= "' . $endMonth . '"')
                ->get();

      return $results;
    }

    /**
     * Get top sell item in range time.
     * @param  [type] $param [description]
     * @return [type]        [description]
     */
    public function topSellItem($start, $end, $limit) {
      $results = $this->model->join('carts', 'carts.bill_id', '=', 'bills.id')
                  ->leftJoin('books', 'books.id', '=', 'carts.item_id')
                  ->leftJoin('bundles', 'bundles.id', '=', 'carts.item_id')
                  ->select(['carts.item_id',
                            DB::raw('SUM(carts.count) as num_item'),
                            'carts.type',
                            DB::raw('if(type='.Cart::TYPE_BOOK.', books.title, bundles.title) as title')])
                  ->whereRaw('DATE(date_purchased) >= "'. $start.'" and DATE(date_purchased) <= "'.$end.'"')

                  ->whereNull('carts.deleted_at')
                  ->whereNull('books.deleted_at')
                  ->whereNull('bundles.deleted_at')
                  ->groupBy('carts.item_id', 'carts.type')
                  ->take($limit)
                  ->get();

      return $results;
    }
}
