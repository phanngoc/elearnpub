<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Price;
use DB;

class PriceRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
      return Price::class;
    }

    /**
     * Update price for book.
     * @return [type] [description]
     */
    public function updatePriceBook($bookId, $params) {
      $result = $this->model->where('item_id', $bookId)
                            ->where('type', Price::TYPE_BOOK)
                            ->update($params);
      return $result;
    }
}
